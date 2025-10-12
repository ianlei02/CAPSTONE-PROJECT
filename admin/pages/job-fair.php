<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PESO Dashboard</title>
  <title>PESO Job Fair</title>
  <script src="../js/load-saved.js"></script>
  <script src="../js/dark-mode.js"></script>
  <link rel="stylesheet" href="../css/navs.css">
  <link rel="stylesheet" href="../css/job-fair.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
</head>

<body>
  <!-- Sidebar -->
  <div class="sidebar">
    <div class="logo">
      <div class="logo-icon">
        <img src="../../public/smb-images/pesosmb.png" alt="PESO Logo" />
      </div>
      <h2>PESO</h2>
    </div>
    <ul class="nav-menu">
      <li><a class="nav-item active" href="./dashboard.php">
          <span class="material-symbols-outlined">dashboard</span>
          <span>Dashboard</span>
        </a>
      </li>
      <li><a class="nav-item" href="./employer-table.php">
          <span class="material-symbols-outlined">apartment</span>
          <span>Employers</span>
        </a>
      </li>
      <li><a class="nav-item" href="./job-listings.php">
          <span class="material-symbols-outlined">list_alt</span>
          <span>Job Listings</span>
        </a>
      </li>
      <li><a class="nav-item" href="./new-admin.php">
          <span class="material-symbols-outlined">groups</span>
          <span>New Admin</span>
        </a>
      </li>
      <li><a class="nav-item" href="./news-upload.php">
          <span class="material-symbols-outlined">newspaper</span>
          <span>News</span>
        </a>
      </li>
      <li><a class="nav-item" href="./job-fair.php">
          <span class="material-symbols-outlined">calendar_month</span>
          <span>Job Fair</span>
        </a>
      </li>
      <li>
        <button class="nav-item" id="themeToggle" onclick="toggleTheme()">
          <span class="material-symbols-outlined" id="themeIcon">dark_mode</span>
          <span id="themeLabel">Theme toggle</span>
        </button>
      </li>
    </ul>
    <ul class="nav-menu logout">
      <li>
        <a class="nav-item" href="../Function/logout.php">
          <span class="material-symbols-outlined">settings</span>
          <span>Logout</span>
        </a>
      </li>
    </ul>
  </div>

  <!-- Main Content -->
  <main class="main-content">
    <div class="header">
      <h1>Job Fair Calendar</h1>
      <div style="display: flex; align-items: center; gap: 20px">
        <div class="user-profile">
          <img src="https://ui-avatars.com/api/?name=Admin+User&background=4f46e5&color=fff" alt="Admin User" />
          <div>
            <p>Ian Lei Castillo</p>
            <span>SUPER ADMIN</span>
          </div>
        </div>
      </div>
    </div>

    <div class="content-wrapper">
      <div class="calendar-container">
        <h2>Admin Event Calendar</h2>
        <div id="calendar"></div>
      </div>
    </div>
  </main>

  <!-- Calendar Script -->
  <script>
  document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('calendar');

    const calendar = new FullCalendar.Calendar(calendarEl, {
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'timeGridWeek,dayGridMonth,listWeek'
      },
      initialView: 'timeGridWeek',
      selectable: true,
      editable: true,
      eventDisplay: 'block',
      allDaySlot: false,

      slotMinTime: '07:00:00',
      slotMaxTime: '24:00:00',

      events: '../Function/calendar-events.php',

      select: function (info) {
        const title = prompt('Enter event title:');
        if (title) {
          const type = prompt('Enter event type (interview or job_fair):', 'job_fair');
          const description = prompt('Enter event description:', '');

          let endDate = new Date(info.end);
          endDate.setSeconds(endDate.getSeconds() - 1);

          const payload = {
            action: 'add',
            title: title,
            start: info.startStr,
            end: endDate.toISOString(),
            type: type,
            description: description
          };

          fetch('../Function/calendar-events.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
          })
            .then(async res => {
              const text = await res.text();
              try { return JSON.parse(text); }
              catch { console.error('Invalid JSON:', text); alert('⚠️ Server error'); return {}; }
            })
            .then(data => {
              if (data.status === 'success') {
                alert('✅ Event added!');
                calendar.refetchEvents();
              } else {
                alert('⚠️ ' + (data.message || 'Error adding event.'));
              }
            });
        }
      },

     eventClick: function (info) {
        const action = prompt(
          `Event: ${info.event.title}\nType: ${info.event.extendedProps.type}\n\nChoose action:\n1. Edit title\n2. Edit Description\n3. Delete\n\nEnter 1, 2 or 3:`
        );

        if (action === '1') {
          const newTitle = prompt('Enter new title:', info.event.title);
          if (newTitle && newTitle !== info.event.title) {
            fetch('../Function/calendar-events.php', {
              method: 'POST',
              headers: { 'Content-Type': 'application/json' },
              body: JSON.stringify({
                action: 'update',
                id: info.event.id,
                title: newTitle
              })
            })
              .then(res => res.json())
              .then(data => {
                if (data.status === 'updated') {
                  alert('✏️ Event title updated!');
                  calendar.refetchEvents();
                } else {
                  alert('⚠️ ' + (data.message || 'Error updating title.'));
                }
              });
          }
        } else if (action === '2') {
          const newDesc = prompt('Enter new description:', info.event.extendedProps.description || '');
          if (newDesc && newDesc !== info.event.extendedProps.description) {
            fetch('../Function/calendar-events.php', {
              method: 'POST',
              headers: { 'Content-Type': 'application/json' },
              body: JSON.stringify({
                action: 'updateDescription',
                id: info.event.id,
                description: newDesc
              })
            })
              .then(res => res.json())
              .then(data => {
                if (data.status === 'updated') {
                  alert('✏️ Event description updated!');
                  calendar.refetchEvents();
                } else {
                  alert('⚠️ ' + (data.message || 'Error updating description.'));
                }
              });
          }
        } else if (action === '3') {
          if (confirm('Delete this event?')) {
            fetch('../Function/calendar-events.php', {
              method: 'POST',
              headers: { 'Content-Type': 'application/json' },
              body: JSON.stringify({ action: 'delete', id: info.event.id })
            })
              .then(res => res.json())
              .then(data => {
                if (data.status === 'deleted') {
                  alert('🗑️ Event deleted!');
                  calendar.refetchEvents();
                } else {
                  alert('⚠️ ' + (data.message || 'Error deleting event.'));
                }
              });
          }
        }
      },

      eventDrop: handleEventChange,
      eventResize: handleEventChange,

      eventDidMount: function (info) {
        const type = info.event.extendedProps.type;
        if (type === 'job_fair') info.el.style.backgroundColor = '#4f46e5';
        else if (type === 'interview') info.el.style.backgroundColor = '#16a34a';
        info.el.style.color = '#fff';
      }
    });

    calendar.render();

    function handleEventChange(info) {
      const endTime = info.event.end
        ? info.event.end.toISOString()
        : info.event.start.toISOString();

      const payload = {
        action: 'updateTime',
        id: info.event.id,
        start: info.event.start.toISOString(),
        end: endTime
      };

      fetch('../Function/calendar-events.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(payload)
      })
        .then(res => res.json())
        .then(data => {
          if (data.status === 'updated') {
            console.log('Event time updated');
          } else {
            alert('⚠️ ' + (data.message || 'Error updating event time.'));
          }
        });
    }
  });
  </script>
</body>
</html>

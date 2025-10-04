<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PESO Dashboard</title>
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
        <img
          src="../../public/smb-images/pesosmb.png"
          alt="PESO Logo" />
      </div>
      <h2>PESO</h2>
    </div>
    <ul class="nav-menu">
      <li>
        <a class="nav-item active" href="./dashboard.php">
          <span class="material-symbols-outlined">dashboard</span>
          <span>Dashboard</span>
        </a>
      </li>
      <li>
        <a class="nav-item" href="./employer-table.php">
          <span class="material-symbols-outlined">apartment</span>
          <span>Employers</span>
        </a>
      </li>
      <li>
        <a class="nav-item" href="./job-listings.php">
          <span class="material-symbols-outlined">list_alt</span>
          <span>Job Listings</span>
        </a>
      </li>
      <li>
        <a class="nav-item" href="./new-admin.php">
          <span class="material-symbols-outlined">groups</span>
          <span>New Admin</span>
        </a>
      </li>
      <li>
        <a class="nav-item" href="./news-upload.php">
          <span class="material-symbols-outlined">newspaper</span>
          <span>News</span>
        </a>
      </li>
      <li>
        <a class="nav-item" href="./job-fair.php">
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
      <h1>Job Fair</h1>
      <div style="display: flex; align-items: center; gap: 20px">
        <div class="user-profile">
          <img
            src="https://ui-avatars.com/api/?name=Admin+User&background=4f46e5&color=fff"
            alt="Admin User" />
          <div>
            <p>Ian Lei Castillo</p>
            <span>SUPER ADMIN</span>
          </div>
          <!-- <i class="fas fa-chevron-down"></i> -->
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
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const calendarEl = document.getElementById('calendar');
      const calendar = new FullCalendar.Calendar(calendarEl, {
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek' // Added views
        },
        initialView: 'dayGridMonth',
        selectable: true,
        editable: true,
        events: 'fetch_events.php',
        select: function(info) {
          const title = prompt('Enter event title:');
          if (title) {
            const type = prompt('Enter event type (interview or job_fair):');
            const eventData = {
              title: title,
              start: info.startStr,
              end: info.endStr,
              type: type
            };
            fetch('add_event.php', {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/json'
                },
                body: JSON.stringify(eventData)
              })
              .then(res => res.json())
              .then(() => calendar.refetchEvents());
          }
        },
        eventClick: function(info) {
          if (confirm('Do you want to delete this event?')) {
            fetch('delete_event.php', {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                  id: info.event.id
                })
              })
              .then(res => res.json())
              .then(() => calendar.refetchEvents());
          }
        }
      });

      calendar.render();
    });
  </script>
</body>

</html>
<?php
require_once '../Function/check_login.php';
require "../../connection/dbcon.php";
// session_start();

// header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
// header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
// header("Pragma: no-cache");

// if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
//     header("Location: ../pages/admin-login.php");
//     exit();
// }

$result = $conn->query("SELECT * FROM announcement ORDER BY publish_date DESC");


$editData = null;
if (isset($_GET['edit'])) {
  $id = intval($_GET['edit']);
  $editData = $conn->query("SELECT * FROM announcement WHERE id=$id")->fetch_assoc();
}

?>
<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>News Section</title>
  <script src="../js/load-saved.js"></script>
  <script src="../js/dark-mode.js"></script>
  <link rel="stylesheet" href="../css/navs.css">
  <link rel="stylesheet" href="../css/news-upload.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link rel="stylesheet" href="../assets/library/datatable/dataTables.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
  <div class="alert-container">
    <?php if (isset($_GET['success'])): ?>
      <div class="alert alert-success alert-dismissible fade show shadow" role="alert">
        ✅ News added successfully!
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    <?php endif; ?>

    <?php if (isset($_GET['updated'])): ?>
      <div class="alert alert-info alert-dismissible fade show shadow" role="alert">
        ✏️ News updated successfully!
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    <?php endif; ?>

    <?php if (isset($_GET['deleted'])): ?>
      <div class="alert alert-danger alert-dismissible fade show shadow" role="alert">
        🗑️ News deleted successfully!
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    <?php endif; ?>
  </div>

  <!-- Main Content -->
  <main class="main-content">
    <!-- Header -->
    <div class="header">
      <h1>News Upload</h1>
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
    <div class="content-wrapper">
      <!-- News Form -->
      <form id="newsForm" action="../Function/news-upload.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="action" value="create">

        <div class="form-group">
          <label for="newsTitle" class="form-label">Title</label>
          <input type="text" id="newsTitle" name="newsTitle" class="form-control" placeholder="Enter news title" required>
        </div>
        <div class="form-group">
          <label for="newsDate" class="form-label">Publish Date</label>
          <input type="date" id="newsDate" name="newsDate" class="form-control" required>
        </div>
        <div class="form-group">
          <label class="form-label">Featured Image</label>
          <div class="file-upload">
            <input type="file" id="newsImage" name="newsImage" class="file-upload-input form-control" accept="image/*">
            <label for="newsImage" class="file-upload-label">
              <i class="fas fa-cloud-upload-alt" style="font-size: 24px; margin-bottom: 10px;"></i>
              <div>Click to upload image</div>
              <div style="font-size: 12px; color: var(--text-light);">Recommended size: 1200x630px</div>
            </label>
            <div class="file-upload-preview" id="imagePreview">
              <img id="previewImage" src="#" alt="Preview">
              <button type="button" class="btn btn-danger" id="removeImage" style="margin-top: 10px;">
                <i class="fas fa-trash"></i> Remove Image
              </button>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="newsContent" class="form-label">Content</label>
          <textarea id="newsContent" name="newsContent" class="form-control"></textarea>
        </div>
        <div class="form-group">
          <label for="newsExcerpt" class="form-label">Excerpt (Short Description)</label>
          <textarea id="newsExcerpt" name="newsExcerpt" class="form-control" rows="3" maxlength="200"></textarea>
          <div style="text-align: right; font-size: 12px; color: var(--text-light);">
            <span id="charCount">0</span>/200 characters
          </div>
        </div>
        <div class="form-group" style="display: flex; gap: 10px;">
          <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Publish News
          </button>
          <button type="reset" class="btn" style="background: var(--border);">
            <i class="fas fa-undo"></i> Reset
          </button>
        </div>
      </form>
      <!-- Uploaded News -->
      <div class="news-list">
        <h2>Uploaded News</h2>
        <table class="news-table">
          <thead>
              <th>Title</th>
              <th>Date</th>
              <th>Image</th>
              <th>Excerpt</th>
              <th>Actions</th>
          </thead>
          <tbody id="newsTableBody">
            <!-- Php while loop dito -->
            <?php while ($row = $result->fetch_assoc()): ?>
              <tr>
                <td><?= htmlspecialchars($row['title']); ?></td>
                <td><?= htmlspecialchars($row['publish_date']); ?></td>
                <td>
                  <?php if ($row['image']): ?>
                    <img src="../<?= $row['image']; ?>" alt="News Image" width="100">
                  <?php else: ?>
                    No Image
                  <?php endif; ?>
                </td>
                <td><?= htmlspecialchars($row['excerpt']); ?></td>
                <td>
                  <!-- Edit Button -->
                  <button type="button" class="btn btn-primary editBtn"
                    data-id="<?= $row['id']; ?>"
                    data-title="<?= htmlspecialchars($row['title']); ?>"
                    data-date="<?= $row['publish_date']; ?>"
                    data-image="../<?= $row['image']; ?>"
                    data-excerpt="<?= htmlspecialchars($row['excerpt']); ?>"
                    data-content="<?= htmlspecialchars($row['content']); ?>"
                    >
                    <i class="fas fa-edit"></i> Edit
                  </button>
                  <!-- Delete Button -->
                  <a href="../Function/news-upload.php?action=delete&id=<?= $row['id']; ?>"
                    class="btn btn-danger deleteBtn">
                    <i class="fas fa-trash"></i> Delete
                  </a>
                </td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>
  </main>
  <!-- Edit News Modal -->
  <div class="modal fade" id="editNewsModal" tabindex="-1" aria-labelledby="editNewsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form id="editNewsForm" action="../Function/news-upload.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="action" value="edit">
          <input type="hidden" name="id" id="editNewsId">

          <div class="modal-header">
            <h5 class="modal-title" id="editNewsModalLabel">Edit News</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>

          <div class="modal-body">
            <div class="form-group mb-3">
              <label for="editNewsTitle">Title</label>
              <input type="text" name="newsTitle" id="editNewsTitle" class="form-control" required>
            </div>

            <div class="form-group mb-3">
              <label for="editNewsDate">Publish Date</label>
              <input type="date" name="newsDate" id="editNewsDate" class="form-control" required>
            </div>

            <div class="form-group mb-3">
              <label for="editNewsImage">Featured Image</label>
              <input type="file" name="newsImage" id="editNewsImage" class="form-control" accept="image/*" >

              <div id="currentImagePreview" style="margin-top:10px;">
                <img id="editPreviewImage" src="" alt="Current Image" width="120">
              </div>
            </div>

            <div class="form-group mb-3">
              <label for="editNewsContent">Content</label>
              <textarea name="newsContent" id="editNewsContent" class="form-control"></textarea>
            </div>

            <div class="form-group mb-3">
              <label for="editNewsExcerpt">Excerpt</label>
              <textarea name="newsExcerpt" id="editNewsExcerpt" class="form-control" maxlength="200"></textarea>
            </div>
          </div>

          <div class="modal-footer">
            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Update</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="../assets/JS_JQUERY/jquery-3.7.1.min.js"></script>
  <script src="../assets/library/datatable/dataTables.js"></script>
  <script src="../js/table-init.js"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const editButtons = document.querySelectorAll(".editBtn");

      editButtons.forEach(btn => {
        btn.addEventListener("click", function() {
          document.getElementById("editNewsId").value = this.dataset.id;
          document.getElementById("editNewsTitle").value = this.dataset.title;
          document.getElementById("editNewsDate").value = this.dataset.date;
          
          document.getElementById("editNewsContent").value = this.dataset.content;
          document.getElementById("editNewsExcerpt").value = this.dataset.excerpt;
          if (this.dataset.image) {
            document.getElementById("editPreviewImage").src = this.dataset.image;
            document.getElementById("currentImagePreview").style.display = "block";
            
          } else {
            document.getElementById("currentImagePreview").style.display = "none";
          }
          var myModal = new bootstrap.Modal(document.getElementById("editNewsModal"));
          myModal.show();
        });
      });
    });
  </script>
  <script>
    setTimeout(() => {
      let alerts = document.querySelectorAll('.alert');
      alerts.forEach(alert => {
        let bsAlert = new bootstrap.Alert(alert);
        bsAlert.close();
      });
    }, 4000);

    document.addEventListener("DOMContentLoaded", function() {
      const deleteButtons = document.querySelectorAll(".deleteBtn");

      deleteButtons.forEach(btn => {
        btn.addEventListener("click", function(e) {
          e.preventDefault();
          const url = this.getAttribute("href");

          Swal.fire({
            title: 'Are you sure?',
            text: "This news will be permanently deleted!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = url;
            }
          });
        });
      });
    });
  </script>

</body>

</html>
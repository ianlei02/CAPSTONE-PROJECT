<?php
// session_start();

// header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
// header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
// header("Pragma: no-cache");

// if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
//     header("Location: ../pages/admin-login.php");
//     exit();
// }
?>
<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>News Section</title>
  <script src="../js/dark-mode.js"></script>
  <link rel="stylesheet" href="../css/navs.css">
  <link rel="stylesheet" href="../css/news-upload.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>

<body>
  <!-- Sidebar -->
  <div class="sidebar">
    <div class="logo">
      <div class="logo-icon">
        <img
          src="../../landing/assets/images/pesosmb.png"
          alt="PESO Logo" />
      </div>
      <h2 style="font-size: 2.25rem">PESO</h2>
    </div>
    <ul class="nav-menu">
      <li>
        <a class="nav-item" href="./dashboard.php">
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
        <a class="nav-item active" href="./news-upload.php">
          <span class="material-symbols-outlined">newspaper</span>
          <span>News</span>
        </a>
      </li>
      <li>
        <a class="nav-item" href="../Function/logout.php">
          <span class="material-symbols-outlined">settings</span>
          <span>Logout</span>
        </a>
      </li>
      <li></li>
      <button class="theme-toggle" id="themeToggle" onclick="toggleTheme()">
        <span class="material-symbols-outlined">dark_mode</span>
      </button>
    </ul>

  </div>

  <!-- Main Content -->
  <div class="main-content">
    <!-- Header -->
    <div class="header">
      <h1>Admin Dashboard</h1>
      <div class="user-profile">
        <img
          src="https://ui-avatars.com/api/?name=Admin+User&background=4f46e5&color=fff"
          alt="Admin User" />
        <span>Admin User</span>
        <!-- <i class="fas fa-chevron-down"></i> -->
      </div>
    </div>

    <!-- News Form -->
    <form id="newsForm">
      <div class="form-title">
        <h2>Upload News</h2>
      </div>
      <div class="form-group">
        <label for="newsTitle" class="form-label">Title</label>
        <input type="text" id="newsTitle" class="form-control" placeholder="Enter news title" required>
      </div>

      <div class="form-group">
        <label for="newsDate" class="form-label">Publish Date</label>
        <input type="date" id="newsDate" class="form-control" required>
      </div>

      <div class="form-group">
        <label class="form-label">Featured Image</label>
        <div class="file-upload">
          <input type="file" id="newsImage" class="file-upload-input form-control" accept="image/*">
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
        <textarea id="newsContent" class="form-control"></textarea>
      </div>

      <div class="form-group">
        <label for="newsExcerpt" class="form-label">Excerpt (Short Description)</label>
        <textarea id="newsExcerpt" class="form-control" rows="3" maxlength="200"></textarea>
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
          <tr>
            <th>Title</th>
            <th>Date</th>
            <th>Image</th>
            <th>Excerpt</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody id="newsTableBody">
          <!-- Php while loop dito -->
          <tr>
            <td>Sample News Title</td>
            <td>2023-10-01</td>
            <td><img src="https://via.placeholder.com/100" alt="News Image"></td>
            <td>This is a short excerpt of the news content.</td>
            <td>
              <button class="btn btn-primary">
                <i class="fas fa-edit"></i> Edit
              </button>
              <button class="btn btn-danger">
                <i class="fas fa-trash"></i> Delete
              </button>
            </td>
          </tr>
          <tr>
            <td>Sample News Title</td>
            <td>2023-10-01</td>
            <td><img src="https://via.placeholder.com/100" alt="News Image"></td>
            <td>This is a short excerpt of the news content.</td>
            <td>
              <button class="btn btn-primary">
                <i class="fas fa-edit"></i> Edit
              </button>
              <button class="btn btn-danger">
                <i class="fas fa-trash"></i> Delete
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

</body>

</html>
<?php
require_once __DIR__.'/inc/Category.php';
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}
$catModel = new Category();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $desc = $_POST['description'];
    $catModel->create($title,$desc);
}
$categories = $catModel->all();
include __DIR__.'/inc/header.php';
?>
<h3>Categories</h3>
<table class="table table-bordered">
<tr><th>Title</th><th>Description</th></tr>
<?php foreach($categories as $c): ?>
<tr><td><?= htmlspecialchars($c['title']) ?></td><td><?= htmlspecialchars($c['description']) ?></td></tr>
<?php endforeach; ?>
</table>
<form method="post" class="mt-4">
 <div class="mb-3">
  <label class="form-label">Title</label>
  <input type="text" name="title" class="form-control" required>
 </div>
 <div class="mb-3">
  <label class="form-label">Description</label>
  <textarea name="description" class="form-control"></textarea>
 </div>
 <button class="btn btn-primary">Add Category</button>
</form>
<?php include __DIR__.'/inc/footer.php'; ?>

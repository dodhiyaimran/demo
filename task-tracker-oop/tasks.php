<?php
require_once __DIR__.'/inc/Task.php';
require_once __DIR__.'/inc/Category.php';
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}
$taskModel = new Task();
$catModel = new Category();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $taskModel->create($_POST['title'],$_POST['description'],$_POST['category_id'],$_SESSION['admin_id']);
}
$tasks = $taskModel->all();
$categories = $catModel->all();
include __DIR__.'/inc/header.php';
?>
<h3>Tasks</h3>
<table class="table table-bordered">
<tr><th>Title</th><th>Status</th><th>Category</th><th></th></tr>
<?php foreach($tasks as $t): ?>
<tr>
 <td><a href="view_task.php?id=<?= $t['id'] ?>"><?= htmlspecialchars($t['title']) ?></a></td>
 <td><?= htmlspecialchars($t['status']) ?></td>
 <td><?= htmlspecialchars($t['category']) ?></td>
 <td></td>
</tr>
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
 <div class="mb-3">
  <label class="form-label">Category</label>
  <select name="category_id" class="form-select">
   <?php foreach($categories as $c): ?>
   <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['title']) ?></option>
   <?php endforeach; ?>
  </select>
 </div>
 <button class="btn btn-primary">Add Task</button>
</form>
<?php include __DIR__.'/inc/footer.php'; ?>

 <main class="flex-grow-1">
     <div class="container-fluid px-3 px-md-5 py-4">
         <!-- Header Banner -->
         <div class="bg-primary rounded-4 text-center py-5 mb-4">
             <h1 class="display-4 fw-bold text-white">Category Table</h1>
         </div>

         <!-- Categories Management Section -->
         <div class="bg-body-secondary rounded-4 p-4">
             <div class="d-flex justify-content-between align-items-center mb-4">
                 <h2 class="fs-3 fw-bold mb-0">Categories</h2>
                 <button class="btn btn-primary px-4" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                     Add Category
                 </button>
             </div>

             <!-- Responsive Table -->
             <div class="table-responsive rounded-3 overflow-hidden">
                 <table class="table table-dark table-hover mb-0">
                     <thead class="bg-secondary bg-opacity-25">
                         <tr>
                             <th class="text-center" style="width: 8%;">#</th>
                             <th>Category Name</th>
                             <th class="text-end">Action</th>
                         </tr>
                     </thead>
                     <tbody class="bg-dark bg-opacity-10">
                         <?php if (isset($data['categories']) && count($data['categories']) !== 0) : ?>
                             <?php foreach ($data['categories'] as $d) : ?>
                                 <tr class="align-middle">
                                     <td class="text-center"><?= array_search($d, $data['categories']) + 1 ?></td>
                                     <td><?= $d['name'] ?></td>
                                     <td class="text-end">
                                         <button class="btn btn-link text-primary p-1"
                                             data-bs-toggle="modal" data-bs-target="#editCategoryModal<?= $d['id'] ?>">
                                             <i class="bi bi-pencil-square fs-5"></i>
                                         </button>
                                         <button class="btn btn-link text-danger p-1"
                                             data-bs-toggle="modal" data-bs-target="#deleteConfirmModal<?= $d['id'] ?>">
                                             <i class="bi bi-trash3-fill fs-5"></i>
                                         </button>
                                     </td>
                                 </tr>

                                 <div class="modal fade" id="editCategoryModal<?= $d['id'] ?>" tabindex="-1">
                                     <div class="modal-dialog">
                                         <div class="modal-content">
                                             <div class="modal-header">
                                                 <h5 class="modal-title">Edit Category</h5>
                                                 <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                             </div>
                                             <div class="modal-body">
                                                 <form id="editCategoryForm" name="editCategoryForm" action="<?= BASE_URL ?>/category/update" method="post" onsubmit="return  editCheckForm()">
                                                     <input type="hidden" id="editId" name="editId" value="<?= $d['id'] ?>">
                                                     <div class="mb-3">
                                                         <label for="editName" class="form-label">Category Name</label>
                                                         <input type="text" class="form-control" id="editName" name="editName" value="<?= $d['name'] ?>" placeholder="Enter category name" required>
                                                     </div>
                                                     <p class="text-danger" id="nameErrEdit"></p>
                                             </div>
                                             <div class="modal-footer">
                                                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                 <button type="submit" class="btn btn-success">Save Changes</button>
                                             </div>
                                             </form>
                                         </div>
                                     </div>
                                 </div>

                                 <div class="modal fade" id="deleteConfirmModal<?= $d['id'] ?>" tabindex="-1">
                                     <div class="modal-dialog">
                                         <div class="modal-content">
                                             <div class="modal-header">
                                                 <h5 class="modal-title text-danger">Confirm Deletion</h5>
                                                 <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                             </div>
                                             <div class="modal-body">
                                                 <form id="deleteForm" name="deleteForm" action="<?= BASE_URL ?>/category/delete/<?= $d['id'] ?>" method="post">
                                                     <div class="mb-4">
                                                         <input type="hidden" id="deleteId" name="deleteId" value="<?= $d['id'] ?>">
                                                         <p>Are you sure you want to delete the category <strong id="deleteCategoryName">"<?= $d['name'] ?>"</strong>?<br>
                                                             This may affect associated movies.</p>
                                                     </div>
                                             </div>
                                             <div class="modal-footer">
                                                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                 <button type="submit" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
                                             </div>
                                             </form>
                                         </div>
                                     </div>
                                 </div>
                             <?php endforeach ?>
                         <?php else : ?>
                             <h4>No Categories Yet</h4>
                         <?php endif ?>
                     </tbody>
                 </table>
             </div>
         </div>
     </div>
 </main>

 <div class="modal fade" id="addCategoryModal" tabindex="-1">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">Add New Category</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
             </div>
             <div class="modal-body">
                 <form id="addCategoryForm" method="post" action="<?= BASE_URL ?>/category/create" onsubmit="return addCheckForm()">
                     <div class="mb-3">
                         <label for="addName" class="form-label">Category Name</label>
                         <input type="text" class="form-control" id="addName" name="addName" placeholder="Enter category name" required>
                     </div>
                     <p class="text-danger" id="nameErrAdd"></p>
                 </form>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                 <button type="submit" form="addCategoryForm" class="btn btn-primary">Add Category</button>
             </div>
         </div>
     </div>
 </div>

 <script>
     const editForm = document.getElementById('editCategoryForm');
     const addForm = document.getElementById('addCategoryForm');
     const nameE = document.forms['editCategoryForm']['editName'];
     const nameA = document.forms['addCategoryForm']['addName'];
     const nameErrE = document.getElementById('nameErrEdit');
     const nameErrA = document.getElementById('nameErrAdd');


     window.onload = function() {
         addform.reset();
     }

     function editCheckForm() {
         nameErrE.textContent = ''

         if (nameE.value.trim().length === 0 || nameE.value === '') {
             nameErrE.textContent = 'Category Name is empty!';
             return false;
         }
         return true;
     }

     function addCheckForm() {
         nameErrA.textContent = ''

         if (nameA.value.trim().length === 0 || nameA.value === '') {
             nameErrA.textContent = 'Category Name is empty!';
             return false;
         }
         return true;
     }
 </script>
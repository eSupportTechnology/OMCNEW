<?php $__env->startSection('dashboard-content'); ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
    /* Center popup container */
    .popup {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }

    .popup-content {
        background: white;
        padding: 20px;
        border-radius: 25px;
        width: 90%;
        max-width: 500px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .popup-content h2 {
        margin-top: 0;
        text-align: center;
    }

    .form-container {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        position: relative;
        justify-content: center;
    }

    .form-container .icon-input {
        position: relative;
        width: 95%;
    }

    .form-container .icon-input i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #ccc;
    }

    .form-container input {
        width: 100%;
        padding: 10px 10px 10px 40px;
        border-radius: 25px;
        border: 1px solid #ccc;
        outline: none;
    }

    .form-container div {
        width: 48%;
    }

    .form-container .full-width {
        width: 100%;
    }

    .close-popup {
        cursor: pointer;
        position: absolute;
        top: 10px;
        right: 15px;
        font-size: 25px;
        color: #333;
    }

    .form-buttons {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 20px;
    }

    .form-buttons button {
        padding: 10px 20px;
        border: none;
        border-radius: 25px;
        cursor: pointer;
        font-size: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .save-btn {
        background-color: #4CAF50;
        color: white;
    }

    .open-popup-btn {
        display: inline-block;
        padding: 10px 20px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin: 20px;
    }

    .address-card {
        background-color: #fff4f0;
        border: 1px solid #f44336;
        border-radius: 10px;
        padding: 20px;
        margin-top: 20px;
    }

    .address-card h4 {
        font-size: 18px;
        margin-bottom: 10px;
    }

    .address-card .info div {
        font-size: 14px;
        margin-bottom: 5px;
    }

    .actions {
        margin-top: 10px;
    }

    .actions a {
        text-decoration: none;
        color: #f44336;
        font-weight: bold;
        margin-right: 10px;
    }


    .address-card{
        border: 1px solid #93c1fe;
        background: #f8fbff;
    }
</style>


<h3 class="py-2 px-2">Address Book</h3>

<button class="btn btn-primary mt-3" onclick="openPopup()">+ Add New</button>

<!-- Displaying Address Cards -->
<div class="row mt-4">
    <?php $__empty_1 = true; $__currentLoopData = $addresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="col-md-4 mb-3">
            <div class="card address-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="card-title mb-0"><?php echo e($address->full_name); ?></h6>
                        <?php if($address->default): ?>
                            <span class="badge bg-primary">Default</span>
                        <?php endif; ?>
                    </div>
                    <p class="card-text">
                        <?php echo e($address->phone_num); ?><br>
                        <?php echo e($address->email); ?><br>
                        <?php echo e($address->address); ?><?php echo e($address->apartment ? ', ' . $address->apartment : ''); ?><br>
                        <?php echo e($address->city); ?><br>
                        <?php echo e($address->postal_code); ?>

                    </p>
                    <div class="d-flex">
                        <button class="btn btn-sm" onclick="openEditPopup(<?php echo e(json_encode($address)); ?>)" style="color:red">Edit</button>
                        <form action="<?php echo e(route('address.delete', $address->id)); ?>" method="POST" class="ms-2">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-sm text-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <p class="text-center">No addresses found.</p>
    <?php endif; ?>
</div>

<?php if(session('success')): ?>
    <div class="alert alert-success">
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>

<!-- Add  modal -->
<div class="popup" id="popup">
    <div class="popup-content">
        <span class="close-popup" onclick="closePopup()">&times;</span>
        <h3>Add Address</h3>
             <form action="<?php echo e(route('storeAddress')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="form-container">
                    <div class="icon-input">
                        <i class="fas fa-user"></i>
                        <input type="text" name="first_name" placeholder="First name" value="<?php echo e(old('full_name', auth()->user()->name)); ?>" required>
                    </div>
                    <div class="icon-input">
                        <i class="fas fa-phone"></i>
                        <input type="text" name="phone" placeholder="Phone" value="<?php echo e(old('phone_num', auth()->user()->phone_num)); ?>" required>
                    </div>
                    <div class="icon-input">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" placeholder="Email" value="<?php echo e(old('email', auth()->user()->email)); ?>" required>
                    </div>
                    <div class="icon-input">
                        <i class="fas fa-home"></i>
                        <input type="text" name="address" placeholder="Street Address" value="<?php echo e(old('address', auth()->user()->address)); ?>" required>
                    </div>
                    <div class="icon-input">
                        <i class="fas fa-home"></i>
                        <input type="text" name="apartment" placeholder="Apartment, Suite, Unit (Optional)">
                    </div>
                    <div class="icon-input">
                        <i class="fas fa-city"></i>
                        <input type="text" name="city" placeholder="City" required>
                    </div>
                    <div class="icon-input">
                        <i class="fas fa-mail-bulk"></i>
                        <input type="text" name="postal_code" placeholder="Postal code" required>
                    </div>

                    <div class="icon-input checkbox-container" style="display: flex; align-items: center; padding-left: 30px;">
                        <input type="checkbox" name="default" id="default" value="on" style="margin-right: 10px; width: auto;">
                        <label for="default" style="margin: 0;">Set as default address</label>
                    </div>
                </div>
                
                <div class="form-buttons">
                    <button type="submit" class="save-btn">
                        <i class="fas fa-check"></i> Save
                    </button>
                </div>
            </form>

    </div>
</div>

<!-- Edit Address Popup Modal -->
<div class="popup" id="editPopup">
    <div class="popup-content">
        <span class="close-popup" onclick="closeEditPopup()">&times;</span>
        <h4>Edit Address</h4>
        <form id="editAddressForm" action="<?php echo e(route('updateAddress')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="address_id" id="edit_address_id" value="">
            <div class="form-container">
                <div class="icon-input">
                    <i class="fas fa-user"></i>
                    <input type="text" name="first_name" id="edit_first_name" placeholder="First name" required>
                </div>
                <div class="icon-input">
                    <i class="fas fa-phone"></i>
                    <input type="text" name="phone" id="edit_phone" placeholder="Phone" required>
                </div>
                <div class="icon-input">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" id="edit_email" placeholder="Email" required>
                </div>
                <div class="icon-input">
                    <i class="fas fa-home"></i>
                    <input type="text" name="address" id="edit_address" placeholder="Street Address" required>
                </div>
                <div class="icon-input">
                    <i class="fas fa-home"></i>
                    <input type="text" name="apartment" id="edit_apartment" placeholder="Apartment, Suite, Unit (Optional)">
                </div>
                <div class="icon-input">
                    <i class="fas fa-city"></i>
                    <input type="text" name="city" id="edit_city" placeholder="City" required>
                </div>
                <div class="icon-input">
                    <i class="fas fa-mail-bulk"></i>
                    <input type="text" name="postal_code" id="edit_postal_code" placeholder="Postal code" required>
                </div>
                <div class="icon-input checkbox-container" style="display: flex; align-items: center; padding-left: 30px;">
                    <input type="checkbox" name="default" id="edit_default" style="margin-right: 10px; width: auto;">
                    <label for="edit_default" style="margin: 0;">Set as default address</label>
                </div>
            </div>
            <div class="form-buttons">
                <button type="submit" class="save-btn">
                    <i class="fas fa-check"></i> Update
                </button>
            </div>
        </form>
    </div>
</div>


<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this address?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <form id="deleteAddressForm" method="POST" action="<?php echo e(route('address.delete', ['id' => 0])); ?>">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>



   

<!-- Popup container for adding address -->
<div class="popup" id="popup">
    <div class="popup-content">
        <span class="close-popup" onclick="closePopup()">&times;</span>
        <h2>Add Address</h2>
        <form action="<?php echo e(route('storeAddress')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="form-container">
                <div class="icon-input">
                    <i class="fas fa-user"></i>
                    <input type="text" name="full_name" placeholder="Full name" value="<?php echo e(old('full_name', auth()->user()->name)); ?>" required>
                </div>
                <div class="icon-input">
                    <i class="fas fa-phone"></i>
                    <input type="text" name="phone_num" placeholder="Phone" value="<?php echo e(old('phone_num', auth()->user()->phone_num)); ?>" required>
                </div>
                <div class="icon-input">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" placeholder="Email" value="<?php echo e(old('email', auth()->user()->email)); ?>" required>
                </div>
                <div class="icon-input">
                    <i class="fas fa-home"></i>
                    <input type="text" name="address" placeholder="Street Address" value="<?php echo e(old('address')); ?>" required>
                </div>
                <div class="icon-input">
                    <i class="fas fa-home"></i>
                    <input type="text" name="apartment" placeholder="Apartment, Suite, Unit (Optional)">
                </div>
                <div class="icon-input">
                    <i class="fas fa-city"></i>
                    <input type="text" name="city" placeholder="City" value="<?php echo e(old('city')); ?>" required>
                </div>
                <div class="icon-input">
                    <i class="fas fa-mail-bulk"></i>
                    <input type="text" name="postal_code" placeholder="Postal code" value="<?php echo e(old('postal_code')); ?>" required>
                </div>
            </div>
            <div class="form-buttons">
                <button type="submit" class="save-btn"><i class="fas fa-check"></i> Save</button>
            </div>
        </form>
    </div>
</div>


<!-- JavaScript -->
<script>
    function openPopup() {
        document.getElementById("popup").style.display = "flex";
    }

    function closePopup() {
        document.getElementById("popup").style.display = "none";
    }

    function showDeleteModal(addressId) {
        let formAction = '<?php echo e(route("address.delete", ":id")); ?>';
        formAction = formAction.replace(':id', addressId);
        document.getElementById('deleteAddressForm').action = formAction;
        $('#deleteModal').modal('show');
    }

    function openEditPopup(address) {
        document.getElementById('edit_address_id').value = address.id;
        document.getElementById('edit_first_name').value = address.full_name;
        document.getElementById('edit_phone').value = address.phone_num;
        document.getElementById('edit_email').value = address.email;
        document.getElementById('edit_address').value = address.address;
        document.getElementById('edit_apartment').value = address.apartment;
        document.getElementById('edit_city').value = address.city;
        document.getElementById('edit_postal_code').value = address.postal_code;
        document.getElementById('edit_default').checked = address.default;

        document.getElementById('editPopup').style.display = 'flex';
    }

    function closeEditPopup() {
        document.getElementById('editPopup').style.display = 'none';
    }
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('member_dashboard.user_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Manulas Doc\Project\Intern\Project\omcnew project\OMCNEW\resources\views/member_dashboard/addresses.blade.php ENDPATH**/ ?>
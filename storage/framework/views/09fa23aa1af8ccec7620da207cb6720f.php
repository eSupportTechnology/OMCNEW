<?php $__env->startSection('content'); ?>

<style>
    .small-input {
        padding: 4px 8px;
        font-size: 14px;
    }
</style>  

<main style="margin-top: 58px">
    <div class="container pt-4 px-4"> 
        <h3 class="py-3">My Websites</h3>

        <div class="card mb-4">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-4 mb-2 d-flex align-items-center">
                        <h5 class="py-3" style="font-weight: bold;">Basic Information</h5>
                    </div>
                    <div class="col-md-8 d-flex justify-content-end">
                        <span class="filter-option me-3 text-primary" data-mdb-toggle="offcanvas" data-mdb-target="#offcanvasBasic" aria-controls="offcanvasBasic" style="cursor: pointer;">
                            Edit
                        </span>
                    </div>
                     
                    <!-- Edit Basic Information Sidebar-->
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasBasic" aria-labelledby="offcanvasBasicLabel">
                        <div class="offcanvas-header">
                            <h6 id="offcanvasBasicLabel">Edit Basic Information</h6>
                            <button type="button" class="btn-close text-reset" data-mdb-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body" style="font-size:15px;">
                            <form id="editInfoForm" action="<?php echo e(route('affiliate.updateBasicInfo')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <?php if($customer): ?>
                                    <div class="form-group mb-3">
                                        <label for="payeename" class="text-secondary">Payee Name</label>
                                        <input type="text" id="payeename" name="payeename" class="form-control small-input" value="<?php echo e($customer->name); ?>">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="loginemail" class="text-secondary">Login Email</label>
                                        <input type="email" id="loginemail" name="loginemail" class="form-control small-input" value="<?php echo e($customer->email); ?>">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="loginphone" class="text-secondary">Login Phone Number</label>
                                        <input type="text" id="loginphone" name="loginphone" class="form-control small-input" value="<?php echo e($customer->contactno); ?>">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="contactmail" class="text-secondary">Contact Email</label>
                                        <input type="email" id="contactmail" name="contactmail" class="form-control small-input" value="<?php echo e($customer->email); ?>">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="contactphone" class="text-secondary">Contact Phone Number</label>
                                        <input type="text" id="contactphone" name="contactphone" class="form-control small-input" value="<?php echo e($customer->contactno); ?>">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-create">Submit</button>
                                <?php endif; ?>
                            </form>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <tbody>
                                <?php if($customer): ?>
                                <tr>
                                    <td><strong>Login email</strong><br><?php echo e($customer->email); ?></td>
                                    <td><strong>Password</strong><br>*********</td>
                                    <td><strong>Login phone number</strong><br><?php echo e($customer->contactno ?: '-'); ?></td>
                                    <td><strong>Contact email</strong><br><?php echo e($customer->email); ?></td>
                                    <td><strong>Payee Name</strong><br><?php echo e($customer->name); ?></td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>  
        </div>



        <div class="card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-4 mb-2 d-flex align-items-center">
                        <h5 class="py-3" style="font-weight: bold;">Site Information</h5>
                    </div>
                    <div class="col-md-8 d-flex justify-content-end">
                        <span class="filter-option me-3 text-primary" data-mdb-toggle="offcanvas" data-mdb-target="#offcanvasSite" aria-controls="offcanvasSite" style="cursor: pointer;">
                            Edit
                        </span>
                        <span class="filter-option text-success" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#promotionFormModal">
                            Add
                        </span>

                    </div>
                        <!-- Edit Site Information Sidebar -->
                        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasSite" aria-labelledby="offcanvasSiteLabel">
                            <div class="offcanvas-body" style="font-size:15px;">
                                <form id="editSiteForm" action="<?php echo e(route('affiliate.updateSiteInfo')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <div class="form-group mb-3">
                                        <label class="text-secondary mb-3" style="font-size: 18px;">Promotion Methods</label>
                                        <?php
                                            // Decode the customer's selected promotion methods
                                            $promotionMethods = is_array($customer->promotion_method) 
                                                ? $customer->promotion_method 
                                                : json_decode($customer->promotion_method, true);
                                            
                                            // Default to an empty array if no promotion methods are available
                                            $promotionMethods = $promotionMethods ?: [];


                                            // Define all possible promotion methods
                                            $allMethods = ['Instagram', 'Facebook', 'TikTok', 'YouTube', 'Content website/blog', 'WhatsApp'];
                                        ?>
                                        <div>
                                        <?php $__currentLoopData = $allMethods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $isChecked = in_array($method, $promotionMethods);
                                                
                                                // Determine the correct URL value for the method
                                                if ($method === 'Content website/blog') {
                                                    $urlValue = $isChecked ? $customer->content_website_url : '';
                                                } elseif ($method === 'WhatsApp') {
                                                    $urlValue = $isChecked ? $customer->content_whatsapp_url : '';
                                                } else {
                                                    $urlValue = $isChecked ? $customer->{strtolower(str_replace(' ', '_', $method)) . '_url'} : '';
                                                }
                                            ?>
                                            <div class="form-check">
                                                <input class="form-check-input promotion-method-checkbox" type="checkbox" 
                                                    id="promotion_method_<?php echo e($loop->index); ?>" 
                                                    name="promotion_methods[]" 
                                                    value="<?php echo e($method); ?>" 
                                                    data-method="<?php echo e(strtolower(str_replace(' ', '_', $method))); ?>" 
                                                    <?php echo e($isChecked ? 'checked' : ''); ?>>
                                                <label class="form-check-label" for="promotion_method_<?php echo e($loop->index); ?>">
                                                    <?php echo e($method); ?>

                                                </label>
                                            </div>
                                            <div class="form-group mb-4">
                                                <input type="text" id="<?php echo e(strtolower(str_replace(' ', '_', $method))); ?>_url" 
                                                    name="<?php echo e(strtolower(str_replace(' ', '_', $method)) === 'content_website/blog' ? 'content_website_url' : strtolower(str_replace(' ', '_', $method)) . '_url'); ?>" 
                                                    class="form-control small-input method-input" 
                                                    data-method="<?php echo e(strtolower(str_replace(' ', '_', $method))); ?>" 
                                                    value="<?php echo e($urlValue); ?>" 
                                                    <?php echo e($isChecked ? '' : 'disabled'); ?>> 
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-create">Submit</button>
                                </form>

                            </div>
                        </div>

                    <div class="">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td><strong>Promotion Methods</strong><br>
                                            <?php if(!empty($customer->promotion_method)): ?>
                                                <?php
                                                    $promotion_methods = is_array($customer->promotion_method) ? $customer->promotion_method : json_decode($customer->promotion_method, true);
                                                ?>
                                                <?php if(is_array($promotion_methods)): ?>
                                                    <ul>
                                                        <?php $__currentLoopData = $promotion_methods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <li><?php echo e($method); ?></li>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </ul>
                                                <?php else: ?>
                                                    <p><?php echo e($promotion_methods); ?></p>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <p>No promotion methods available</p>
                                            <?php endif; ?>
                                        </td>
                                        <td><strong>Channel Type</strong><br>Social</td>
                                        <td><strong>Social media platform</strong><br>
                                            <?php if(!empty($customer->instagram_url)): ?>
                                                Instagram: <a href="<?php echo e($customer->instagram_url); ?>" target="_blank"><?php echo e($customer->instagram_url); ?></a><br>
                                            <?php endif; ?>
                                            <?php if(!empty($customer->facebook_url)): ?>
                                                Facebook: <a href="<?php echo e($customer->facebook_url); ?>" target="_blank"><?php echo e($customer->facebook_url); ?></a><br>
                                            <?php endif; ?>
                                            <?php if(!empty($customer->tiktok_url)): ?>
                                                TikTok: <a href="<?php echo e($customer->tiktok_url); ?>" target="_blank"><?php echo e($customer->tiktok_url); ?></a><br>
                                            <?php endif; ?>
                                            <?php if(!empty($customer->youtube_url)): ?>
                                                YouTube: <a href="<?php echo e($customer->youtube_url); ?>" target="_blank"><?php echo e($customer->youtube_url); ?></a><br>
                                            <?php endif; ?>
                                            <?php if(!empty($customer->content_website_url)): ?>
                                                Website: <a href="<?php echo e($customer->content_website_url); ?>" target="_blank"><?php echo e($customer->content_website_url); ?></a><br>
                                            <?php endif; ?>
                                            <?php if(!empty($customer->content_whatsapp_url)): ?>
                                                WhatsApp: <a href="<?php echo e($customer->content_whatsapp_url); ?>" target="_blank"><?php echo e($customer->content_whatsapp_url); ?></a><br>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>


            </div>  
        </div>
    </div>

    <div class="card mt-4">
    <div class="card-body">
        <div class="row align-items-center">
            <div class="col-md-4 mb-2 d-flex align-items-center">
                <h5 class="py-3" style="font-weight: bold;">Bank Information</h5>
            </div>
           <div class="col-md-8 d-flex justify-content-end">
                <span class="filter-option me-3 text-primary" style="cursor: pointer;"
                    data-bs-toggle="offcanvas" data-bs-target="#offcanvasBankInfo" aria-controls="offcanvasBankInfo">
                    Edit
                </span>
                <span class="filter-option text-success" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#bankInfoModal">
                    Add
                </span>
            </div>


            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td><strong>Bank Name</strong><br><?php echo e($customer->bank_name ?? 'N/A'); ?></td>
                                <td><strong>Branch</strong><br><?php echo e($customer->branch ?? 'N/A'); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Account Name</strong><br><?php echo e($customer->account_name ?? 'N/A'); ?></td>
                                <td><strong>Account Number</strong><br><?php echo e($customer->account_number ?? 'N/A'); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Bank Info Sidebar -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasBankInfo" aria-labelledby="offcanvasBankInfoLabel">
    <div class="offcanvas-header">
        <h5 id="offcanvasBankInfoLabel">Edit Bank Information</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <form action="<?php echo e(route('affiliate.updateBankInfo')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="form-group mb-3">
                <label for="bank_name">Bank Name</label>
                <input type="text" class="form-control" name="bank_name" id="bank_name" value="<?php echo e($customer->bank_name ?? ''); ?>">
            </div>
            <div class="form-group mb-3">
                <label for="branch">Branch</label>
                <input type="text" class="form-control" name="branch" id="branch" value="<?php echo e($customer->branch ?? ''); ?>">
            </div>
            <div class="form-group mb-3">
                <label for="account_name">Account Name</label>
                <input type="text" class="form-control" name="account_name" id="account_name" value="<?php echo e($customer->account_name ?? ''); ?>">
            </div>
            <div class="form-group mb-3">
                <label for="account_number">Account Number</label>
                <input type="text" class="form-control" name="account_number" id="account_number" value="<?php echo e($customer->account_number ?? ''); ?>">
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>

</div>


        
</div>

<!-- Modal -->
<div class="modal fade" id="promotionFormModal" tabindex="-1" aria-labelledby="promotionFormModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="promotionFormModalLabel">Promotional Methods</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?php echo e(route('affiliate.add.promotions')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="row mb-3">
                <label class="col-md-4 col-form-label text-md-start">Promotion Method</label>
                <div class="col-md-7">
                    <?php
                        $selected = old('promotion_method') ?? json_decode($affiliate->promotion_method ?? '[]');
                    ?>
                    <?php $__currentLoopData = ['Instagram', 'Facebook', 'TikTok', 'YouTube', 'Content website/blog', 'WhatsApp']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="form-check">
                            <input class="form-check-input <?php $__errorArgs = ['promotion_method'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                type="checkbox" name="promotion_method[]" value="<?php echo e($method); ?>"
                                id="<?php echo e(strtolower(str_replace(' ', '_', $method))); ?>"
                                <?php echo e(in_array($method, $selected) ? 'checked' : ''); ?>>
                            <label class="form-check-label" for="<?php echo e(strtolower(str_replace(' ', '_', $method))); ?>"><?php echo e($method); ?></label>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php $__errorArgs = ['promotion_method'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-feedback" role="alert"><strong><?php echo e($message); ?></strong></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            <?php $__currentLoopData = [
                'instagram_url' => 'Instagram Profile URL',
                'facebook_url' => 'Facebook Page URL',
                'tiktok_url' => 'TikTok Profile URL',
                'youtube_url' => 'YouTube Channel URL',
                'content_website_url' => 'Content Website/Blog URL',
                'content_whatsapp_url' => 'WhatsApp Group URL'
            ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="row mb-3">
                    <label for="<?php echo e($name); ?>" class="col-md-4 col-form-label text-md-start"><?php echo e($label); ?></label>
                    <div class="col-md-7">
                        <input id="<?php echo e($name); ?>" type="url" class="form-control <?php $__errorArgs = [$name];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            name="<?php echo e($name); ?>" value="<?php echo e(old($name, $affiliate->$name ?? '')); ?>">
                        <?php $__errorArgs = [$name];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-feedback" role="alert"><strong><?php echo e($message); ?></strong></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <div class="row">
                <div class="col-md-11 text-end">
                    <button type="submit" class="btn btn-primary">Add Promotions</button>
                </div>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>



<hr class="my-5">

<!-- Bank Info Modal -->
<div class="modal fade" id="bankInfoModal" tabindex="-1" aria-labelledby="bankInfoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="bankInfoModalLabel">Payment Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?php echo e(route('affiliate.add.bank')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <?php $__currentLoopData = [
                'bank_name' => 'Bank Name',
                'branch' => 'Branch',
                'account_name' => 'Account Name',
                'account_number' => 'Account Number'
            ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="row mb-3">
                    <label for="<?php echo e($field); ?>" class="col-md-4 col-form-label text-md-start">
                        <?php echo e($label); ?> <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-7">
                        <input id="<?php echo e($field); ?>" type="text" class="form-control <?php $__errorArgs = [$field];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            name="<?php echo e($field); ?>" value="<?php echo e(old($field, $affiliate->$field ?? '')); ?>" required>
                        <?php $__errorArgs = [$field];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-feedback" role="alert"><strong><?php echo e($message); ?></strong></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <div class="row">
                <div class="col-md-11 text-end">
                    <button type="submit" class="btn btn-success">Add Bank Info</button>
                </div>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>


   
        
</main>



<script>
  document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('.promotion-method-checkbox');
    const inputs = document.querySelectorAll('.method-input');

    // Function to update input disabled state based on checkbox status
    const updateInputDisabledState = (checkbox) => {
        const method = checkbox.getAttribute('data-method');
        const input = document.querySelector(`.method-input[data-method="${method}"]`);
        if (input) {
            input.disabled = !checkbox.checked; // Toggle disabled state
            console.log(`Changed ${method} input to ${checkbox.checked ? 'editable' : 'disabled'}`);
        }
    };

    // Initially set the disabled state for inputs based on the checkboxes
    inputs.forEach(input => {
        const method = input.getAttribute('data-method');
        const relatedCheckbox = document.querySelector(`.promotion-method-checkbox[data-method="${method}"]`);
        if (relatedCheckbox) {
            input.disabled = !relatedCheckbox.checked; // Set initial state
            console.log(`Setting ${method} input to ${relatedCheckbox.checked ? 'editable' : 'disabled'}`);
        }
    });

    // Add event listeners to checkboxes to toggle disabled status of inputs
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            updateInputDisabledState(checkbox);
        });
    });
});
</script>

<script>
    function togglePromotionForm() {
        const form = document.getElementById('promotionForm');
        form.style.display = (form.style.display === 'none' || form.style.display === '') ? 'block' : 'none';
    }
</script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.affiliate_main.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\OMCNEW\resources\views/affiliate_dashboard/mywebsites_page.blade.php ENDPATH**/ ?>
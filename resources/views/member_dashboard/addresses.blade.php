@extends('member_dashboard.user_sidebar')

@section('dashboard-content')

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
<!-- Enhanced CSS for Address Cards -->
<style>
    .address-cards-container {
        padding: 20px 0;
    }

    .address-card {
        background: linear-gradient(145deg, #ffffff, #f8f9fa);
        border: 1px solid #e3e6ea;
        border-radius: 15px;
        padding: 24px;
        margin-bottom: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05), 0 1px 3px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .address-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        border-color: #4CAF50;
    }

    .address-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: linear-gradient(180deg, #4CAF50, #45a049);
        border-radius: 0 2px 2px 0;
    }

    .address-card-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 16px;
        flex-wrap: wrap;
        gap: 8px;
    }

    .address-card-title {
        font-size: 18px;
        font-weight: 600;
        color: #2c3e50;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .address-card-title i {
        color: #4CAF50;
        font-size: 16px;
    }

    .default-badge {
        background: linear-gradient(135deg, #4CAF50, #45a049);
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 2px 4px rgba(76, 175, 80, 0.3);
    }

    .address-card-content {
        margin-bottom: 20px;
    }

    .address-info-row {
        display: flex;
        align-items: center;
        margin-bottom: 8px;
        color: #555;
        font-size: 14px;
        line-height: 1.5;
    }

    .address-info-row i {
        width: 20px;
        color: #4CAF50;
        margin-right: 12px;
        font-size: 14px;
        flex-shrink: 0;
    }

    .address-info-row span {
        flex: 1;
        word-break: break-word;
    }

    .address-card-actions {
        display: flex;
        gap: 12px;
        padding-top: 16px;
        border-top: 1px solid #e9ecef;
        flex-wrap: wrap;
    }

    .action-btn {
        padding: 8px 16px;
        border: none;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        gap: 6px;
        text-decoration: none;
        min-width: 80px;
        justify-content: center;
    }

    .edit-btn {
        background: linear-gradient(135deg, #17a2b8, #138496);
        color: white;
        border: 1px solid transparent;
    }

    .edit-btn:hover {
        background: linear-gradient(135deg, #138496, #117a8b);
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(23, 162, 184, 0.3);
        color: white;
        text-decoration: none;
    }

    .delete-btn {
        background: linear-gradient(135deg, #dc3545, #c82333);
        color: white;
        border: 1px solid transparent;
    }

    .delete-btn:hover {
        background: linear-gradient(135deg, #c82333, #bd2130);
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(220, 53, 69, 0.3);
        color: white;
    }

    .no-addresses {
        text-align: center;
        padding: 60px 20px;
        color: #6c757d;
        background: #f8f9fa;
        border-radius: 15px;
        border: 2px dashed #dee2e6;
    }

    .no-addresses i {
        font-size: 48px;
        color: #dee2e6;
        margin-bottom: 16px;
        display: block;
    }

    .no-addresses h4 {
        margin-bottom: 8px;
        color: #495057;
        font-weight: 600;
    }

    .no-addresses p {
        margin: 0;
        font-size: 14px;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .address-card {
            padding: 20px;
            margin-bottom: 16px;
        }

        .address-card-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 12px;
        }

        .address-card-title {
            font-size: 16px;
        }

        .default-badge {
            align-self: flex-start;
        }

        .address-card-actions {
            justify-content: center;
        }

        .action-btn {
            flex: 1;
            min-width: 120px;
        }
    }

    @media (max-width: 576px) {
        .address-cards-container {
            padding: 10px 0;
        }

        .address-card {
            padding: 16px;
        }

        .address-info-row {
            font-size: 13px;
        }

        .address-card-actions {
            flex-direction: column;
        }

        .action-btn {
            min-width: 100%;
        }
    }
</style>

<!-- Enhanced Displaying Address Cards -->
<div class="address-cards-container">
    <div class="row">
        @forelse($addresses as $address)
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                <div class="address-card">
                    <div class="address-card-header">
                        <h6 class="address-card-title">
                            <i class="fas fa-user-circle"></i>
                            {{ $address->full_name }}
                        </h6>
                        @if($address->default)
                            <span class="default-badge">
                                <i class="fas fa-star"></i> Default
                            </span>
                        @endif
                    </div>

                    <div class="address-card-content">
                        <div class="address-info-row">
                            <i class="fas fa-phone"></i>
                            <span>{{ $address->phone_num }}</span>
                        </div>
                        <div class="address-info-row">
                            <i class="fas fa-envelope"></i>
                            <span>{{ $address->email }}</span>
                        </div>
                        <div class="address-info-row">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>
                                {{ $address->address }}{{ $address->apartment ? ', ' . $address->apartment : '' }}<br>
                                {{ $address->city }}, {{ $address->postal_code }}
                            </span>
                        </div>
                    </div>

                    <div class="address-card-actions">
                        <button class="action-btn edit-btn" onclick="openEditPopup({{ json_encode($address) }})">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <form action="{{ route('address.delete', $address->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-btn delete-btn" onclick="return confirm('Are you sure you want to delete this address?')">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="no-addresses">
                    <i class="fas fa-address-book"></i>
                    <h4>No Addresses Found</h4>
                    <p>You haven't added any addresses yet. Click "Add New" to create your first address.</p>
                </div>
            </div>
        @endforelse
    </div>
</div>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<!-- Add  modal -->
<div class="popup" id="popup">
    <div class="popup-content">
        <span class="close-popup" onclick="closePopup()">&times;</span>
        <h3>Add Address</h3>
             <form action="{{ route('storeAddress') }}" method="POST">
                @csrf
                <div class="form-container">
                    <div class="icon-input">
                        <i class="fas fa-user"></i>
                        <input type="text" name="first_name" placeholder="First name" value="{{ old('full_name', auth()->user()->name) }}" required>
                    </div>
                    <div class="icon-input">
                        <i class="fas fa-phone"></i>
                        <input type="text" name="phone" placeholder="Phone" value="{{ old('phone_num', auth()->user()->phone_num) }}" required>
                    </div>
                    <div class="icon-input">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" placeholder="Email" value="{{ old('email', auth()->user()->email) }}" required>
                    </div>
                    <div class="icon-input">
                        <i class="fas fa-home"></i>
                        <input type="text" name="address" placeholder="Street Address" value="{{ old('address', auth()->user()->address) }}" required>
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
        <form id="editAddressForm" action="{{ route('updateAddress') }}" method="POST">
            @csrf
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
        <form id="deleteAddressForm" method="POST" action="{{ route('address.delete', ['id' => 0]) }}">
            @csrf
            @method('DELETE')
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
        <form action="{{ route('storeAddress') }}" method="POST">
            @csrf
            <div class="form-container">
                <div class="icon-input">
                    <i class="fas fa-user"></i>
                    <input type="text" name="full_name" placeholder="Full name" value="{{ old('full_name', auth()->user()->name) }}" required>
                </div>
                <div class="icon-input">
                    <i class="fas fa-phone"></i>
                    <input type="text" name="phone_num" placeholder="Phone" value="{{ old('phone_num', auth()->user()->phone_num) }}" required>
                </div>
                <div class="icon-input">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" placeholder="Email" value="{{ old('email', auth()->user()->email) }}" required>
                </div>
                <div class="icon-input">
                    <i class="fas fa-home"></i>
                    <input type="text" name="address" placeholder="Street Address" value="{{ old('address') }}" required>
                </div>
                <div class="icon-input">
                    <i class="fas fa-home"></i>
                    <input type="text" name="apartment" placeholder="Apartment, Suite, Unit (Optional)">
                </div>
                <div class="icon-input">
                    <i class="fas fa-city"></i>
                    <input type="text" name="city" placeholder="City" value="{{ old('city') }}" required>
                </div>
                <div class="icon-input">
                    <i class="fas fa-mail-bulk"></i>
                    <input type="text" name="postal_code" placeholder="Postal code" value="{{ old('postal_code') }}" required>
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
        let formAction = '{{ route("address.delete", ":id") }}';
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

@endsection

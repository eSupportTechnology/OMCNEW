@extends('layouts.admin_main.master')

@section('content')

<main style="margin-top: 58px">
    <div class="container px-5 py-5">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="mb-1 mx-5">Product Details</h3>
        </div>

        <div class="card p-5 mx-5">
            <div class="row">
                <div class="col-md-7"> 
                    <div class="row mb-2">
                        <div class="col-12"><strong class="me-2">Product ID:</strong>{{ $product->product_id }}</div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-12"><strong class="me-2">Name:</strong>{{ $product->product_name }}</div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-12"><strong class="me-2">Images:</strong>
                            <div class="d-flex flex-wrap">
                                @foreach($product->images as $image)
                                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="Product Image" class="img-thumbnail" width="100" style="margin-right: 5px;">
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-12">
                            <strong class="me-2">Description:</strong>
                            {!! $product->product_description !!}
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-12"><strong class="me-2">Category:</strong>{{ $product->product_category }}</div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-12"><strong class="me-2">In Stock Quantity:</strong>{{ $product->quantity }}</div>
                    </div>
                </div>

                <div class="col-md-5"> 
                    <div class="row mb-2">
                        <div class="col-12"><strong class="me-2">Normal Price:</strong> Rs {{ $product->normal_price }}</div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-12"><strong class="me-2">Affiliate:</strong> {{ $product->is_affiliate ? 'Yes' : 'No' }}</div>
                    </div>

                    @if($product->is_affiliate)
                        <div class="affiliate-fields">
                            <div class="row mb-2">
                                <div class="col-12"><strong class="me-2">Affiliate Price:</strong> Rs {{ $product->affiliate_price }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-12"><strong class="me-2">Commission:</strong> {{ $product->commission_percentage }}%</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-12"><strong class="me-2">Total Price:</strong> Rs {{ $product->total_price }}</div>
                            </div>
                        </div>
                    @endif
                    @if($product->variations->where('type', 'Size')->isNotEmpty())
                        <div class="row mb-2">
                            <div class="col-12 d-flex">
                                <strong class="me-2">Sizes:</strong>
                                @php
                                    $sizes = $product->variations->where('type', 'Size');
                                @endphp
                                <ul style="list-style-type: none; padding-left: 0; margin: 0;">
                                    @foreach($sizes as $size)
                                        <li class="d-inline-block me-3">{{ $size['value'] }} - {{ $size['quantity'] }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    @if($product->variations->where('type', 'Color')->isNotEmpty())
                        <div class="row mb-2">
                            <div class="col-12 d-flex">
                                <strong class="me-2">Colors:</strong>
                                <ul style="list-style-type: none; padding-left: 0; margin: 0;">
                                    @foreach($product->variations->where('type', 'Color') as $color)
                                        <li class="d-inline-block me-3" style="vertical-align: middle;">
                                            <span style="display: inline-block; background-color: {{ $color->hex_value }}; border: 1px solid #e8ebec; height: 20px; width: 20px;" 
                                            title="{{ $color->hex_value }}"></span> 
                                            <span style="position: relative; top: -2px;" class="ms-1"> - {{ $color['quantity'] }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    @if($product->variations->where('type', 'Material')->isNotEmpty())
                    <div class="row mb-2">
                        <div class="col-12"><strong class="me-2">Material:</strong>
                            @php
                                $materials = $product->variations->where('type', 'Material'); 
                            @endphp
                            @foreach($materials as $material)
                                <span>{{ $material['value'] }} </span>
                                @if (!$loop->last)
                                    <span>, </span>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    @endif
                    <div class="row mb-2">
                        <div class="col-12"><strong class="me-2">Tags :</strong>{{ $product->tags }}</div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/color-name-list@4.11.0/dist/colornames.min.js"></script>

@endsection

@extends('Components.Layout')

@section('title', 'Home')

@section('content')
<div class="hero-section">
    <div class="container">
        <h1>Welcome to Mac and Gab</h1>
        <p>We are happy to fulfill your cravings</p>
        <a href="{{ route('ageverification') }}">
        <button>Verify Age</button>
    </a>
    </div>  
</div>

<!-- Messages Section -->
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif
@if(session('order_placed'))
    <div class="alert alert-success">{{ session('order_placed') }}</div>
@endif
@if(session('order_canceled'))
    <div class="alert alert-info">{{ session('order_canceled') }}</div>
@endif

<!-- Categories and Menu Items -->
<div class="container">
    <div class="row">
        <!-- Categories Section -->
        <div class="col-md-9">
            <div class="search-bar mb-3">
                <form action="{{ route('home') }}" method="GET" class="d-flex align-items-center">
                    <input type="text" name="search" placeholder="Search menu items..." class="form-control me-2" />
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>

            @php
                $iconMapping = [
                    'Silog meals' => 'silog.png',
                    'Rice bowls' => 'Rice bowls.png',
                    'Beverages' => 'beverages.png',
                    'Pasta' => 'pasta.png',
                ];
            @endphp

            <ul class="nav nav-tabs mb-3" id="categoryTabs" role="tablist">
                @foreach($categories as $index => $category)
                    <li class="nav-item" role="presentation">
                        <a class="nav-link{{ $index === 0 ? ' active' : '' }}" id="tab-{{ $category->id }}" data-bs-toggle="tab" href="#category-{{ $category->id }}" role="tab">
                            @php $icon = $iconMapping[$category->name] ?? 'default.png'; @endphp
                            <img src="{{ asset('icons/' . $icon) }}" alt="{{ $category->name }}" class="category-icon" />
                            {{ $category->name }}
                        </a>
                    </li>
                @endforeach
            </ul>

            <div class="tab-content" id="categoryTabsContent">
                @foreach($categories as $index => $category)
                    <div class="tab-pane fade{{ $index === 0 ? ' show active' : '' }}" id="category-{{ $category->id }}" role="tabpanel">
                        <div class="row">
                            @foreach($menuItems->where('category_id', $category->id) as $item)
                                <div class="col-md-3 mb-4">
                                    <div class="menu-item">
                                        <img src="{{ asset('images/food.png') }}" alt="food" class="menu-item-image" />
                                        <h5>{{ $item->name }}</h5>
                                        <p>{{ number_format($item->price, 2) }}</p>
                                        <form action="{{ route('order.add') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="item_id" value="{{ $item->id }}" />
                                            <input type="number" name="quantity" min="1" value="1" class="form-control mb-2" />
                                            <button type="submit" class="btn btn-success">Add to Order</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Ordering Section -->
        <div class="col-md-3 d-none d-md-block">
            <div class="ordering text-center">
                <h4>Your Order</h4>
                @if(Session::has('order') && count(Session::get('order')) > 0)
                    <ul class="list-group mb-4">
                        @foreach(Session::get('order') as $item)
                            <li class="list-group-item">
                                {{ $item['name'] }} - {{ $item['quantity'] }} x {{ number_format($item['price'], 2) }} = {{ number_format($item['quantity'] * $item['price'], 2) }}
                            </li>
                        @endforeach
                    </ul>
                    <p><strong>Total: {{ number_format(Session::get('order_total'), 2) }}</strong></p>
                    <div class="d-flex justify-content-between">
                        <form action="{{ route('order.place') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success">Place Order</button>
                        </form>
                        <form action="{{ route('order.cancel') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-secondary">Cancel</button>
                        </form>
                    </div>
                @else
                    <p>Your order is empty.</p>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal for Order Confirmation -->
<div class="modal fade" id="orderPlacedModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Order Placed</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Your order has been placed successfully! Thank you for ordering.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .category-icon {
        width: 24px;
        height: 24px;
        margin-right: 8px;
    }
    .menu-item-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if(session('order_placed'))
            var alert = document.createElement('div');
            alert.className = 'alert alert-success';
            alert.innerText = "{{ session('order_placed') }}";
            document.querySelector('.container').prepend(alert);
        @endif

        $(document).ready(function() {
        $('#ageModal').modal('show'); // Show the modal when the page loads
    });
    });

</script>
@endpush

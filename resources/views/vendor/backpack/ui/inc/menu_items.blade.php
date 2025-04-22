{{-- This file is used for menu items by any Backpack v6 theme --}}
@once
    @push('before_styles')
        @livewireStyles
    @endpush

    @push('after_scripts')
        @livewireScripts
    @endpush
@endonce
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i>
        {{ trans('backpack::base.dashboard') }}</a></li>

<x-backpack::menu-dropdown title="Product Management" icon="la la-group">
    <x-backpack::menu-dropdown-item title="Products" icon="la la-id-card-alt" :link="backpack_url('product')" />
    <x-backpack::menu-dropdown-item title="Categories" icon="la la-tags" :link="backpack_url('category')" />
    <x-backpack::menu-dropdown-item title="Brands" icon="la la-building" :link="backpack_url('brand')" />
    <x-backpack::menu-dropdown-item title="Product images" icon="la la-image" :link="backpack_url('product-image')" />
    <x-backpack::menu-dropdown-item title="Catalogs" icon="la la-blind" :link="backpack_url('catalog')" />
</x-backpack::menu-dropdown>

<x-backpack::menu-item title="Profile" icon="la la-user" :link="backpack_url('profile')" />

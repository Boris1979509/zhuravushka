@extends('layouts.app')
@php /** @var ProductCategory $category */use App\Models\Shop\ProductCategory;@endphp
@section('title', $category->title)
@section('description', $category->description)

@section('content')
    <section id="catalog">
        <div class="container">
            <div class="catalog">
                <div class="catalog__sorting">
                    <div class="catalog__sorting-options">
                        <span class="title">Сортировать по:</span>
                        <a href="{{ route('category', $category->slug) }}"
                           class="catalog__sorting-link  active">{{ __('All') }}</a>
                        <a href="{{ route('category', $category->slug . '?sort=price') }}"
                           class="catalog__sorting-link">Цене</a>
                        <a href="{{ route('category', $category->slug . '?sort=popular') }}"
                           class="catalog__sorting-link">Популярности</a>
                        <a href="{{ route('category', $category->slug . '?sort=name') }}" class="catalog__sorting-link">Названию</a>
                        <div class="sort-in-stock">
                            <form action="{{ route('category', $category->slug) }}" method="GET">
                                <input type="checkbox" name="sortInStock" class="catalog__sorting-link"
                                       id="sort-in-stock" onchange="this.form.submit()" @if(request()->has('sortInStock')) checked @endif>
                                <label for="sort-in-stock">Показать в наличии</label>
                            </form>
                        </div>
                    </div>

                    <div class="catalog__sorting-icons">
                        <div class="mode-tile active">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M15 9H9V15H15V9Z" fill="#C0C0C0"/>
                                <path d="M5.99998 0H0V5.99998H5.99998V0Z" fill="#C0C0C0"/>
                                <path d="M15 18H9V24H15V18Z" fill="#C0C0C0"/>
                                <path d="M5.99998 9H0V15H5.99998V9Z" fill="#C0C0C0"/>
                                <path d="M5.99998 18H0V24H5.99998V18Z" fill="#C0C0C0"/>
                                <path d="M24 0H18V5.99998H24V0Z" fill="#C0C0C0"/>
                                <path d="M15 0H9V5.99998H15V0Z" fill="#C0C0C0"/>
                                <path d="M24 9H18V15H24V9Z" fill="#C0C0C0"/>
                                <path d="M24 18H18V24H24V18Z" fill="#C0C0C0"/>
                            </svg>
                        </div>
                        <div class="mode-simple">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M0 0H5V6H0V0Z" fill="#C0C0C0"/>
                                <path d="M8 0H24V6H8V0Z" fill="#C0C0C0"/>
                                <path d="M0 9H5V15H0V9Z" fill="#C0C0C0"/>
                                <path d="M8 9H24V15H8V9Z" fill="#C0C0C0"/>
                                <path d="M0 18H5V24H0V18Z" fill="#C0C0C0"/>
                                <path d="M8 18H24V24H8V18Z" fill="#C0C0C0"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <h1>{{ $category->title }}</h1>
                <div class="catalog__wrap">
                    <div class="catalog__subsection">
                        @if(!is_null($category->children))
                            <ul class="catalog__category">
                                @foreach($category->children as $categoryItem)
                                    <a href="{{ route('category', $categoryItem->slug) }}"
                                       title="{{ $categoryItem->title }}" class="catalog__category-link">
                                        <li class="catalog__subsections-item">{{ $categoryItem->title }} <span
                                                class="item-qty">{{ $categoryItem->productCount }}</span>
                                        </li>
                                    </a>
                                @endforeach
                            </ul>
                        @endif
                        <form action="{{ route('category', $category->slug) }}" method="GET">
                            <div class="catalog__price">
                                <span class="catalog__price-title">{{ __('PriceTitle') }}</span>
                                <div class="catalog__price__wrapper">
                                    <input type="number" name="priceFrom" placeholder="{{ __('From') }}" value="{{ old('priceFrom') }}"
                                           class="input catalog__price-from">
                                    <span class="line">—</span>
                                    <input type="number" name="priceTo" placeholder="{{ __('To') }}" value="{{ old('priceTo') }}"
                                           class="input catalog__price-to">
                                </div>
                            </div>
                            <div class="catalog__brand">
                                <span class="catalog__brand-title">{{ __('BrandTitle') }}</span>
                                <div class="catalog__brand__wrapper">
                                    <ul>
                                        <div class="catalog__word__wrap">

                                            <input type="radio" id="ladogaz" name="brand" value="ladogaz"
                                                   class="catalog__brand-input">
                                            <label for="ladogaz">Ладогаз</label>

                                            <input type="radio" id="lemax" name="brand" value="lemax"
                                                   class="catalog__brand-input">

                                            <label for="lemax">ЛЕМАКС</label>
                                            <input type="radio" name="brand" id="ariston" value="ariston"
                                                   class="catalog__brand-input">
                                            <label for="ariston">Ariston</label>
                                        </div>
                                    </ul>
                                </div>
                            </div>
                            <div class="catalog__confirm">
                                <div class="catalog__confirm__wrapper">
                                    <button class="btn btn-active btn__confirm">{{ __('Apply') }}</button>
                                    <a href="#" class="btn__clear">{{ __('Clear') }}</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="catalog__items-section">
                        <div class="cart-container">
                            @include('shop.categoryProducts')
                        </div>
                        @if($products->total() > $products->count())
                            <div class="paginator-wrap">{{ $products->links() }}</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

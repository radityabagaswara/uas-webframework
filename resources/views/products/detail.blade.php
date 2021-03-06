@extends('layouts.user')

@section('title')
    {{ $product->name }} - BukaLaptop.com
@endsection

@section('content')
    <div class="container px-4 mx-auto pb-32">
        @if (session('status'))
            <div class="p-2 m-2 bg-green-500 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex"
                role="alert">
                <span class="flex rounded-full bg-gray-600 uppercase px-2 py-1 text-xs font-bold mr-3">Success!</span>
                <span class="font-semibold mr-2 text-left flex-auto">{{ session('status') }}</span>

            </div>
        @endif
        <div class="grid grid-cols-12 md:gap-x-5">
            <div class="col-span-12 md:col-span-5 my-3 md:my-0 border border-gray-200 p-5">
                <img class="w-full max-h-96 object-contain" src="{{ asset('/images/products/' . $product->image) }}">
            </div>

            <div class="col-span-12 md:col-span-7 my-3 md:my-0">
                <div class="border-b border-gray-200 pb-3">
                    <h4>{{ $product->name }}</h4>
                    <small><a>{{ $product_brand->name }}</a> | <a>{{ $product_category->name }}</a></small>
                </div>
                <div class="mt-5">
                    <dl class="grid grid-cols-12 my-2">
                        <dt class="col-span-4 font-semibold">Price</dt>
                        <dd class="col-span-8">

                            @if ($product->discount > 0)
                                <small class="text-gray-600 "><span class="line-through">Rp.
                                        {{ number_format($product->price) }}</span><span
                                        class="text-red-500">-{{ $product->discount }}%</span></small>
                                @guest
                                    <p class="text-indigo-500 font-semibold">Rp {{ $product->formated_total }}</p>
                                @else
                                    <p class="text-indigo-500 font-semibold">Rp {{ $product->format_total }}</p>
                                @endguest
                            @else
                                @guest
                                    <p class="text-indigo-500 font-semibold">Rp {{ $product->formated_total }}</p>
                                @else
                                    <p class="text-indigo-500 font-semibold">Rp {{ $product->format_total }}</p>
                                @endguest

                            @endif
                        </dd>
                    </dl>

                    <dl class="grid grid-cols-12 my-1">
                        <dt class="col-span-4 font-semibold">Category</dt>
                        <dd class="col-span-8">
                            {{ $product_category->name }}
                            <p><a href="{{ url('categories/' . $product_category->name) }}"><small>More from this
                                        Category</small></a></p>

                        </dd>
                    </dl>

                    <dl class="grid grid-cols-12 my-2">
                        <dt class="col-span-4 font-semibold">Brand</dt>
                        <dd class="col-span-8">
                            {{ $product_brand->name }}
                            <p><a href="{{ url('brands/' . $product_brand->name) }}"><small>More from this
                                        brand</small></a></p>
                        </dd>
                    </dl>

                    <dl class="grid grid-cols-12 my-2">
                        <dt class="col-span-4 font-semibold">Model</dt>
                        <dd class="col-span-8">
                            {{ $product->model }}
                        </dd>
                    </dl>


                    <dl class="grid grid-cols-12 my-2">
                        <dt class="col-span-4 font-semibold">Screen</dt>
                        <dd class="col-span-8">
                            {{ $product->screen_size }} Inches
                        </dd>
                    </dl>
                </div>
            </div>
        </div>

        <div class="mt-5">
            <div class="p-5 border border-gray-200 rounded">
                <ul class="flex flex-row flex-wrap gap-x-5 pb-3 border-b border-gray-300">
                    <li><a href="#desc">
                            <h6 class="text-sm">Description</h6>
                        </a></li>
                    <li><a href="#spec">
                            <h6 class="text-sm">Specification
                            </h6>
                        </a>
                    </li>
                </ul>
                <div class="text-justify pt-3" id="desc">
                    <h5 class="mb-1">Description</h5>
                    {{ $product->description }}
                </div>

                <div class="text-justify pt-3" id="spec">
                    <h5 class="mb-1">Specification</h5>

                    <div>
                        <dl class="grid grid-cols-12 my-1">
                            <dt class="col-span-4 md:col-span-2 font-semibold">Name</dt>
                            <dd class="col-span-10">
                                {{ $product->name }}
                            </dd>
                        </dl>
                        <dl class="grid grid-cols-12 my-1">
                            <dt class="col-span-4 md:col-span-2 font-semibold">Brand</dt>
                            <dd class="col-span-10">
                                {{ $product_brand->name }}
                            </dd>
                        </dl>
                        <dl class="grid grid-cols-12 my-1">
                            <dt class="col-span-4 md:col-span-2 font-semibold">Model</dt>
                            <dd class="col-span-10">
                                {{ $product->model }}
                            </dd>
                        </dl>
                        @guest
                            <dl class="grid grid-cols-12 my-1">
                                <dt class="col-span-4 md:col-span-2 font-semibold"></dt>
                                <dd class="col-span-10">
                                    <a href="{{ url('login') }}">Login to view more</a>
                                </dd>
                            </dl>
                        @else

                            <dl class="grid grid-cols-12 my-1">
                                <dt class="col-span-4 md:col-span-2 font-semibold">Memory</dt>
                                <dd class="col-span-10">
                                    {{ $product->ram }}
                                </dd>
                            </dl>

                            <dl class="grid grid-cols-12 my-1">
                                <dt class="col-span-4 md:col-span-2 font-semibold">Battery</dt>
                                <dd class="col-span-10">
                                    {{ $product->battery_capacity }}
                                </dd>
                            </dl>

                            <dl class="grid grid-cols-12 my-1">
                                <dt class="col-span-4 md:col-span-2 font-semibold">Proccessor</dt>
                                <dd class="col-span-10">
                                    {{ $product->cpu }}
                                </dd>
                            </dl>

                            <dl class="grid grid-cols-12 my-1">
                                <dt class="col-span-4 md:col-span-2 font-semibold">Screen Size</dt>
                                <dd class="col-span-10">
                                    {{ $product->screen_size }} Inches
                                </dd>
                            </dl>

                            <dl class="grid grid-cols-12 my-1">
                                <dt class="col-span-4 md:col-span-2 font-semibold">Hard Disk</dt>
                                <dd class="col-span-10">
                                    {{ $product->hard_disk }}
                                </dd>
                            </dl>
                            <dl class="grid grid-cols-12 my-1">
                                <dt class="col-span-4 md:col-span-2 font-semibold">Storage</dt>
                                <dd class="col-span-10">
                                    {{ $product->hard_disk_capacity }}
                                </dd>
                            </dl>

                            <dl class="grid grid-cols-12 my-1">
                                <dt class="col-span-4 md:col-span-2 font-semibold">Graphic</dt>
                                <dd class="col-span-10">
                                    {{ $product->graphic_card }}
                                </dd>
                            </dl>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="fixed w-screen bottom-0 left-0 shadow-md border-t border-gray-200 bg-white">
        <div class="container px-4 mx-auto py-3">
            @guest
                <div class="flex flex-row flex-wrap justify-between gap-x-5 gap-y-5 md:gap-y-0">
                    <div>
                        <p class="font-semibold">Qty</p>

                        <div class="flex flex-row gap-x-1">
                            <button class="p-3 px-5 border rounded bg-gray-200 cursor-text">-</button>
                            <button class="p-3 px-5 border rounded bg-gray-200 cursor-text" disabled>1</button>
                            <button class="p-3 px-5 border rounded bg-gray-200 cursor-text">+</button>

                        </div>
                    </div>
                    <div class="flex flex-row gap-x-5 items-end">
                        <div>
                            <p>Total</p>
                            <h6>Rp {{ $product->formated_total }}</h6>
                        </div>
                        <button class="btn btn-primary">Login To Add Cart</button>

                    </div>
                @else
                    <div>
                        <form method="post" action="{{ route('cart.add') }}"
                            class="flex flex-row flex-wrap justify-between gap-x-5 gap-y-5 md:gap-y-0">
                            @csrf
                            <div>
                                <p class="font-semibold">Qty</p>

                                <div class="flex flex-row gap-x-1">
                                    <button class="p-3 px-5 border rounded hover:bg-gray-300 transition-all"
                                        id="qty-">-</button>
                                    <input name="product_id" type="hidden" value="{{ $product->id }}" />
                                    <input id="qty_input" name="qty" type="hidden" value="1" />
                                    <button class="p-3 px-5 border rounded bg-gray-200 cursor-text " id="qty" disabled></button>
                                    <button class="p-3 px-5 border rounded hover:bg-gray-300 transition-all"
                                        id="qty+">+</button>
                                </div>
                            </div>
                            <div class="flex flex-row gap-x-5 items-end">
                                <div>
                                    <p>Total</p>
                                    <h6 id="total"></h6>
                                </div>
                                @if (isset(session('cart')[$product->id]))
                                    <button class="btn btn-primary">Update Cart</button>
                                @else
                                    <button class="btn btn-primary">Add to Cart</button>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            @endguest

        </div>
    @endsection

    @section('script')
        @if (isset(session('cart')[$product->id]))
            <script>
                let qty = "{{ session('cart')[$product->id]['qty'] }}";
            </script>
        @else
            <script>
                let qty = 1;
            </script>

        @endif


        <script>
            qty = parseInt(qty);
            let price = ("{{ $product->format_total }}").replace(/,/g, '')
            price = isNaN(price) ? price : parseInt(price);
            let priceAdj = price;

            $('#qty').html(qty);
            $('#qty_input').attr("value", qty);
            $('#total').html("Rp " + priceAdj.toLocaleString());

            $("#qty+").on('click', function(event) {
                event.preventDefault();
                qty += 1;
                priceAdj = price * qty;
                $('#qty').html(qty);
                $('#qty_input').attr("value", qty);
                $('#total').html("Rp " + priceAdj.toLocaleString());

            })

            $("#qty-").on('click', function(event) {
                event.preventDefault();
                if (qty <= 1) qty = 1;
                else
                    qty -= 1;

                priceAdj = price * qty;

                $('#qty').html(qty);
                $('#qty_input').attr("value", qty);
                $('#total').html("Rp " + priceAdj.toLocaleString());
            })
        </script>
    @endsection

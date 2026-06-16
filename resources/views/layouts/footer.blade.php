<footer class="border-t border-[#dbe8f5] bg-[#f4f9ff] py-12">
        <div class="lumiere-container">
            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-[1.4fr_1fr_1fr_1fr_1.4fr]">
                <div>
                    <h3 class="font-['Playfair_Display'] text-4xl font-bold text-[#233a5e]">
                        Lumiere
                    </h3>

                    <p class="mt-4 text-sm leading-7 text-[#5f6f86]">
                        Platform booking beauty & wellness premium. Look good, feel even better.
                    </p>
                </div>

                <div>
                    <h4 class="mb-4 font-bold">Explore</h4>
                    <a href="{{ route('customer.salons.index') }}" class="block text-sm leading-8 text-[#5f6f86]">Salons Near Me</a>
                    <a href="#treatments" class="block text-sm leading-8 text-[#5f6f86]">Treatments</a>
                    <a href="#" class="block text-sm leading-8 text-[#5f6f86]">Deals</a>
                </div>

                <div>
                    <h4 class="mb-4 font-bold">For Partners</h4>
                    <a href="{{ route('owner.salons.index') }}" class="block text-sm leading-8 text-[#5f6f86]">Partner Dashboard</a>
                    <a href="#" class="block text-sm leading-8 text-[#5f6f86]">Resources</a>
                    <a href="#" class="block text-sm leading-8 text-[#5f6f86]">Partner Support</a>
                </div>

                <div>
                    <h4 class="mb-4 font-bold">Support</h4>
                    <a href="#" class="block text-sm leading-8 text-[#5f6f86]">Help Center</a>
                    <a href="#" class="block text-sm leading-8 text-[#5f6f86]">How It Works</a>
                    <a href="#" class="block text-sm leading-8 text-[#5f6f86]">Contact Us</a>
                </div>

                <div>
                    <h4 class="mb-4 font-bold">Stay Glowing</h4>
                    <p class="text-sm leading-7 text-[#5f6f86]">
                        Dapatkan promo dan tips beauty terbaru.
                    </p>

                    <form class="mt-4 flex overflow-hidden rounded-xl border border-[#dbe8f5] bg-white">
                        <input type="email" placeholder="Enter your email" class="flex-1 border-0 px-4 py-3 focus:ring-0">
                        <button class="w-12 bg-[#2f80ed] text-white">➜</button>
                    </form>
                </div>
            </div>

            <div class="mt-10 border-t border-[#dbe8f5] pt-5 text-center text-sm text-[#728199]">
                © {{ date('Y') }} Lumiere. All rights reserved.
            </div>
        </div>
    </footer>
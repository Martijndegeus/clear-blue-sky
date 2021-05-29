<template>
    <div>
        <section class="bg-red-200 text-green-900 relative">
           <div class="min-h-screen hero-image bg-right-bottom bg-cover flex" style="background-image: url('/images/wing-hero-img.jpg');">
                <div class="relative container mx-auto p-4 flex items-end z-10">
                    <div>
                        <div class="content float-left py-4 px-5 my-5">
                            <div class="heading mb-3 text-2xl md:text-4xl">Clear Blue Sky</div>
                            <div class="text leading-normal hidden sm:block">Ticket Finder</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <router-view></router-view>
    </div>
</template>

<script>
export default {}
</script>

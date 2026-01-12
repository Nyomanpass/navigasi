<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GKPB Jemaat Pniel - Navigation</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Background Utama */
        .hero-bg {
			background-image: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.3)), 
                          url('<?php echo base_url("assets/herogambar.webp"); ?>');
            background-size: cover;
            background-position: center;
        }
        /* Efek Gelombang Bawah */
        .wave-bottom {
            clip-path: ellipse(100% 100% at 50% 0%);
        }
    </style>
</head>
<body class="bg-white font-sans antialiased">

    <header class="hero-bg min-h-[70vh] md:min-h-[85vh] relative text-white wave-bottom">
        
        <div class="container mx-auto px-4 py-6 md:py-10">
            <nav class="flex justify-between items-center bg-white/95 backdrop-blur-md rounded-full px-6 py-2 shadow-2xl transition-all">
                <div class="flex items-center space-x-3">
                    <img class="w-10 h-10" src="<?php echo base_url("assets/logo.png"); ?>">
                    <span class="text-black font-black text-sm md:text-lg tracking-tighter">GKPB</span>
                </div>

                <div class="hidden md:flex items-center space-x-8 text-gray-700 font-bold text-sm">
                    <a href="#" class="hover:text-orange-800 transition">Home</a>
                    <a href="#" class="hover:text-orange-800 transition">Rules</a>
                    <a href="<?php echo base_url('navigasi'); ?>" class="hover:text-orange-800 transition">Map</a>
                    <a href="#" class="hover:text-orange-800 transition">Kecak Schedule</a>
                </div>

                <div class="flex items-center space-x-4 text-gray-800">
                    <div class="flex items-center space-x-1 border border-gray-300 rounded-full px-3 py-1 cursor-pointer">
                        <span class="text-xs">🇬🇧</span>
                        <i class="fa-solid fa-chevron-down text-[10px]"></i>
                    </div>
                    <button class="md:hidden text-2xl">
                        <i class="fa-solid fa-bars-staggered"></i>
                    </button>
                </div>
            </nav>

            <div class="mt-32 md:mt-32 text-center max-w-4xl mx-auto px-4">
                <h1 class="text-3xl md:text-6xl lg:text-7xl font-black leading-tight md:leading-none tracking-tight uppercase drop-shadow-lg">
					Welcome to <br> 
					<span class="text-orange-400">GKPB Jemaat "Pniel"</span> <br> 
					<span class="text-2xl md:text-5xl lg:text-6xl block mt-2">Blimbingsari</span>
				</h1>
				<p class="mt-6 text-sm md:text-xl font-medium opacity-90 max-w-2xl mx-auto leading-relaxed">
					Nikmati keindahan arsitektur gereja khas Bali yang unik dan suasana spiritual yang damai di Desa Wisata Blimbingsari.
				</p>
            </div>
        </div>
    </header>

    <main class="container mx-auto px-4 -mt-10 md:-mt-16 relative z-20 pb-20">
        
        <div class="max-w-2xl mx-auto mb-10">
            <div class="bg-green-700/90 backdrop-blur-xl text-white p-6 rounded-[2.5rem] flex items-center justify-between shadow-2xl border border-white/20">
                <div class="flex items-center space-x-5">
                    <div class="bg-white/20 w-14 h-14 flex items-center justify-center rounded-2xl text-3xl">
                        <i class="fa-regular fa-clock"></i>
                    </div>
                    <div>
                        <p class="text-xs uppercase font-bold tracking-[0.3em] opacity-70">Opening Hours</p>
                        <p class="text-xl md:text-2xl font-black">07.00 AM - 07.00 PM</p>
                    </div>
                </div>
                <div class="hidden sm:block bg-white text-green-800 px-4 py-1 rounded-full text-xs font-bold uppercase">
                    Open Now
                </div>
            </div>
        </div>

		<div class="grid grid-cols-2 md:grid-cols-3 gap-8 md:gap-10 max-w-5xl mx-auto px-4">
    
			<a href="<?php echo base_url('rules'); ?>" class="group bg-orange-900 hover:bg-orange-800 p-8 rounded-[2.5rem] flex flex-col items-center justify-center space-y-4 shadow-xl transition-colors border-2 border-orange-200/10">
				<i class="fa-solid fa-clipboard-list text-4xl text-white"></i>
				<span class="text-sm md:text-lg font-black text-white uppercase tracking-tighter">Rules</span>
			</a>

			<a href="<?php echo base_url('navigasi'); ?>" class="group bg-orange-900 hover:bg-orange-800 p-8 rounded-[2.5rem] flex flex-col items-center justify-center space-y-4 shadow-xl transition-colors border-2 border-orange-200/10">
				<i class="fa-solid fa-map-location-dot text-4xl text-white"></i>
				<span class="text-sm md:text-lg font-black text-white uppercase tracking-tighter text-center">Map</span>
			</a>

			<a href="<?php echo base_url('objekwisata'); ?>" class="group col-span-2 md:col-span-1 bg-orange-900 hover:bg-orange-800 p-8 rounded-[2.5rem] flex flex-col items-center justify-center space-y-4 shadow-xl transition-colors border-2 border-orange-200/10">
				<i class="fa-regular fa-calendar-days text-4xl text-white"></i>
				<span class="text-sm md:text-lg font-black text-white uppercase tracking-tighter text-center">Objek Wisata</span>
			</a>

		</div>
    </main>

	<footer class="text-center py-10 text-gray-400 text-[10px] md:text-xs uppercase tracking-[0.3em] font-medium">
		&copy; 2026 GKPB Jemaat "Pniel" Blimbingsari
	</footer>

</body>
</html>
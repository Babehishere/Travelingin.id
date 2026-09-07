<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $destination->name }} | Travelingin.id</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- AOS Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        :root {
            --primary: #0A192F;
            --primary-light: #112240;
            --accent: #D4AF37;
            --accent-light: #E5C76B;
            --white: #FFFFFF;
            --bg-light: #FDFDFD;
            --bg-gray: #F8F9FA;
            --text-main: #1D1D1F;
            --text-muted: #6E6E73;
            --font-heading: 'Playfair Display', serif;
            --font-body: 'Plus Jakarta Sans', sans-serif;
            --transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            --shadow-lg: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            --glass: rgba(255, 255, 255, 0.7);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: var(--font-body); color: var(--text-main); background-color: var(--bg-light); line-height: 1.7; overflow-x: hidden; }
        h1, h2, h3, h4, h5, h6 { font-family: var(--font-heading); color: var(--primary); font-weight: 700; }
        a { text-decoration: none; color: inherit; transition: var(--transition); }
        ul { list-style: none; }
        .container { max-width: 1400px; margin: 0 auto; padding: 0 40px; }

        .btn { display: inline-flex; align-items: center; justify-content: center; padding: 14px 32px; border-radius: 100px; font-weight: 600; cursor: pointer; transition: var(--transition); border: none; gap: 10px; font-size: 0.95rem; }
        .btn-primary { background: linear-gradient(135deg, var(--accent), #B8860B); color: var(--white); box-shadow: 0 8px 20px rgba(212, 175, 55, 0.3); }
        .btn-primary:hover { transform: translateY(-3px); box-shadow: 0 12px 25px rgba(212, 175, 55, 0.4); }
        .btn-outline { background-color: transparent; border: 1px solid rgba(0,0,0,0.1); color: var(--primary); }
        .btn-outline:hover { background-color: var(--primary); color: var(--white); }

        /* Navbar */
        nav { position: fixed; top: 0; left: 0; width: 100%; padding: 15px 5%; display: flex; justify-content: space-between; align-items: center; z-index: 1000; background: var(--glass); backdrop-filter: blur(15px); border-bottom: 1px solid rgba(0,0,0,0.05); }
        .logo img { max-height: 85px; width: auto; }
        .nav-links { display: flex; gap: 30px; }
        .nav-links a { color: var(--primary); font-weight: 500; font-size: 0.9rem; }
        .nav-links a:hover { color: var(--accent); }

        /* Header */
        .detail-header { 
            height: 60vh;
            position: relative;
            background: linear-gradient(rgba(10, 25, 47, 0.4), rgba(10, 25, 47, 0.6)), url('{{ $destination->image ? (Str::startsWith($destination->image, ["http://", "https://"]) ? $destination->image : asset("storage/" . $destination->image)) : "https://images.unsplash.com/photo-1506012733851-bb9745564c73?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80" }}') center/cover;
            display: flex;
            align-items: flex-end;
            padding-bottom: 80px;
            color: var(--white);
        }
        .header-content h1 { font-size: 4rem; color: var(--white); margin-bottom: 15px; }
        .breadcrumb { display: flex; gap: 10px; font-size: 0.9rem; opacity: 0.8; margin-bottom: 15px; }

        /* Layout */
        .detail-layout { display: grid; grid-template-columns: 1fr 400px; gap: 60px; padding: 80px 0; }

        /* Content Area */
        .content-card { background: var(--white); padding: 50px; border-radius: 30px; box-shadow: var(--shadow-lg); }
        .section-title { font-size: 1.8rem; margin-bottom: 25px; display: flex; align-items: center; gap: 15px; }
        .section-title::after { content: ''; height: 2px; flex: 1; background: var(--bg-gray); }
        .description-text { font-size: 1.1rem; color: var(--text-muted); line-height: 1.8; margin-bottom: 40px; }
        
        .features-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 40px; }
        .feature-item { display: flex; align-items: center; gap: 15px; padding: 20px; background: var(--bg-gray); border-radius: 20px; }
        .feature-item i { color: var(--accent); font-size: 1.2rem; }

        /* Sidebar / Booking */
        .booking-sidebar { position: sticky; top: 120px; }
        .booking-card { background: var(--primary); color: var(--white); padding: 40px; border-radius: 30px; box-shadow: var(--shadow-lg); }
        .price-display { margin-bottom: 30px; }
        .price-label { font-size: 0.9rem; opacity: 0.7; display: block; margin-bottom: 5px; }
        .main-price { font-size: 2.5rem; font-weight: 800; color: var(--accent); }
        .old-price { text-decoration: line-through; opacity: 0.5; font-size: 1.2rem; margin-right: 10px; }

        .booking-form { display: flex; flex-direction: column; gap: 15px; margin-top: 30px; }
        .form-group label { display: block; font-size: 0.85rem; margin-bottom: 8px; opacity: 0.8; }
        .form-input { width: 100%; padding: 14px 20px; border-radius: 15px; border: 1px solid rgba(255,255,255,0.1); background: rgba(255,255,255,0.05); color: var(--white); font-family: var(--font-body); }
        .form-input:focus { outline: none; border-color: var(--accent); }

        .booking-btn { width: 100%; margin-top: 20px; font-size: 1.1rem; }

        /* Footer */
        footer { background: var(--primary); color: var(--white); padding: 100px 0 40px; }
        .footer-grid { display: grid; grid-template-columns: 1.5fr 1fr 1fr 1.2fr; gap: 60px; margin-bottom: 60px; }
        .footer-col h4 { color: var(--white); margin-bottom: 25px; text-transform: uppercase; letter-spacing: 2px; font-size: 0.9rem; }
        .footer-links a { color: rgba(255,255,255,0.6); font-size: 0.9rem; transition: var(--transition); }
        .footer-links a:hover { color: var(--accent); padding-left: 8px; }

        @media (max-width: 1100px) {
            .detail-layout { grid-template-columns: 1fr; }
            .booking-sidebar { position: static; }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav>
        <div class="container" style="display: flex; justify-content: space-between; align-items: center; width: 100%; max-width: 100%;">
            <a href="{{ url('/') }}" class="logo">
                <img src="{{ asset('images/logo.png') }}" alt="Travelingin.id Logo">
            </a>
            <ul class="nav-links">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a href="{{ route('about') }}">About</a></li>
                <li><a href="{{ url('/destinations') }}">Destinations</a></li>
                <li><a href="{{ route('special-offers') }}">Special Offers</a></li>
                <li><a href="{{ url('/#contact') }}">Contact Us</a></li>
            </ul>
            <div class="nav-actions">
                @auth
                    <a href="{{ route('profile.edit') }}">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=D4AF37&color=fff&rounded=true" alt="Profile" style="width: 40px; height: 40px; border-radius: 50%; border: 2px solid var(--accent);">
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary" style="padding: 10px 24px;">Login</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Header -->
    <header class="detail-header">
        <div class="container">
            <div class="header-content" data-aos="fade-up">
                <div class="breadcrumb">
                    <a href="{{ url('/') }}">Home</a> / 
                    <a href="{{ url('/destinations') }}">Destinations</a> / 
                    <a href="{{ url('/destinations?type=' . $destination->type) }}">{{ ucfirst($destination->type) }}</a> / 
                    <span>{{ $destination->name }}</span>
                </div>
                <h1>{{ $destination->name }}</h1>
                <div style="display: flex; gap: 20px; align-items: center;">
                    <span style="background: var(--accent); padding: 5px 15px; border-radius: 50px; font-weight: 700; font-size: 0.8rem;">{{ strtoupper($destination->type) }}</span>
                    <span><i class="fas fa-calendar-alt" style="color: var(--accent); margin-right: 8px;"></i> Departure: {{ $destination->travel_date ? \Carbon\Carbon::parse($destination->travel_date)->format('d M Y') : 'TBA' }}</span>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="detail-layout">
            <!-- Left Content -->
            <div class="content-area" data-aos="fade-right">
                <div class="content-card">
                    <h2 class="section-title">Overview</h2>
                    <p class="description-text">{{ $destination->description }}</p>

                    <h2 class="section-title">What's Included</h2>
                    <div class="features-grid">
                        <div class="feature-item">
                            <i class="fas fa-check-circle"></i>
                            <div>
                                <h4 style="font-size: 1rem;">Professional Guide</h4>
                                <p style="font-size: 0.85rem; color: var(--text-muted);">Expert knowledge & local stories</p>
                            </div>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check-circle"></i>
                            <div>
                                <h4 style="font-size: 1rem;">All-in-One Ticket</h4>
                                <p style="font-size: 0.85rem; color: var(--text-muted);">Skip the line at every entrance</p>
                            </div>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check-circle"></i>
                            <div>
                                <h4 style="font-size: 1rem;">Premium Transport</h4>
                                <p style="font-size: 0.85rem; color: var(--text-muted);">Comfortable journey throughout</p>
                            </div>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check-circle"></i>
                            <div>
                                <h4 style="font-size: 1rem;">Gourmet Meals</h4>
                                <p style="font-size: 0.85rem; color: var(--text-muted);">Authentic culinary experiences</p>
                            </div>
                        </div>
                    </div>

                    @if($destination->type !== 'tourguide')
                    <h2 class="section-title">Location Gallery</h2>
                    @php
                        $galleryImages = [];
                        if ($destination->gallery && is_array($destination->gallery) && count($destination->gallery) > 0) {
                            foreach ($destination->gallery as $img) {
                                $galleryImages[] = Str::startsWith($img, ['http://', 'https://']) ? $img : asset('storage/' . $img);
                            }
                        }
                        
                        if (count($galleryImages) < 3) {
                            $lowerName = strtolower($destination->name);
                            $lowerDesc = strtolower($destination->description);
                            
                            if (str_contains($lowerName, 'bromo') || str_contains($lowerName, 'everest') || str_contains($lowerName, 'semeru') || str_contains($lowerName, 'gunung') || str_contains($lowerName, 'mountain') || str_contains($lowerDesc, 'hiking') || str_contains($lowerDesc, 'mendaki')) {
                                $fallbacks = [
                                    'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                                    'https://images.unsplash.com/photo-1544829099-b9a0c07fad1a?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
                                    'https://images.unsplash.com/photo-1454496522488-7a8e488e8606?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80'
                                ];
                            } elseif (str_contains($lowerName, 'penida') || str_contains($lowerName, 'bali') || str_contains($lowerName, 'pantai') || str_contains($lowerName, 'beach') || str_contains($lowerName, 'pangandaran') || str_contains($lowerName, 'laut')) {
                                $fallbacks = [
                                    'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                                    'https://images.unsplash.com/photo-1519046904884-53103b34b206?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
                                    'https://images.unsplash.com/photo-1506929562872-bb421503ef21?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80'
                                ];
                            } else {
                                $fallbacks = [
                                    'https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                                    'https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
                                    'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80'
                                ];
                            }
                            
                            while (count($galleryImages) < 3) {
                                $galleryImages[] = $fallbacks[count($galleryImages)];
                            }
                        }
                    @endphp
                    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 15px;">
                        <img src="{{ $galleryImages[0] }}" style="width: 100%; height: 300px; object-fit: cover; border-radius: 20px;" alt="Gallery 1">
                        <div style="display: flex; flex-direction: column; gap: 15px;">
                            <img src="{{ $galleryImages[1] }}" style="width: 100%; height: 142px; object-fit: cover; border-radius: 20px;" alt="Gallery 2">
                            <img src="{{ $galleryImages[2] }}" style="width: 100%; height: 142px; object-fit: cover; border-radius: 20px;" alt="Gallery 3">
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Right Sidebar (Booking) -->
            <div class="booking-sidebar" data-aos="fade-left">
                <div class="booking-card">
                    <div class="price-display">
                        <span class="price-label">Start From</span>
                        @if($destination->discount_price)
                            <span class="old-price">Rp {{ number_format($destination->price, 0, ',', '.') }}</span>
                            <div class="main-price">Rp {{ number_format($destination->discount_price, 0, ',', '.') }}</div>
                        @else
                            <div class="main-price">Rp {{ number_format($destination->price, 0, ',', '.') }}</div>
                        @endif
                        <span style="opacity: 0.6; font-size: 0.9rem;">per traveler</span>
                    </div>

                    <div style="padding: 15px; background: rgba(255,255,255,0.05); border-radius: 15px; margin-bottom: 25px;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 5px; font-size: 0.9rem;">
                            <span>Availability</span>
                            <span style="color: var(--accent);">{{ $destination->quota > 0 ? $destination->quota . ' seats left' : 'Unlimited' }}</span>
                        </div>
                        <div style="width: 100%; height: 6px; background: rgba(255,255,255,0.1); border-radius: 10px;">
                            <div style="width: 75%; height: 100%; background: var(--accent); border-radius: 10px;"></div>
                        </div>
                    </div>

                    <div style="background: linear-gradient(135deg, rgba(212, 175, 55, 0.1), rgba(255, 255, 255, 0)); border: 1px solid rgba(212, 175, 55, 0.2); padding: 15px 20px; border-radius: 20px; margin-bottom: 25px; display: flex; items-center gap: 15px;">
                        <div style="width: 35px; height: 35px; background: var(--accent); border-radius: 10px; display: flex; items-center justify-center text-primary; flex-shrink: 0;">
                            <i class="fas fa-star" style="font-size: 0.9rem;"></i>
                        </div>
                        <div>
                            <p style="font-size: 0.7rem; font-weight: 700; uppercase; tracking-widest; color: var(--accent); margin-bottom: 2px;">LOYALTY REWARDS</p>
                            <p style="font-size: 0.9rem; font-weight: 600;">Dapatkan <span style="color: var(--accent);">{{ $destination->loyalty_points }} Points</span></p>
                        </div>
                    </div>

                    <form onsubmit="event.preventDefault(); openBookingModal('{{ $destination->id }}', '{{ addslashes($destination->name) }}', '{{ $destination->travel_date }}', {{ $destination->discount_price ?? $destination->price }}, '{{ $destination->type }}'); document.getElementById('modalTravelersInput').value = this.travelers.value; calculateModalPrices();" class="booking-form">
                        <div class="form-group">
                            <label>Fixed Travel Date</label>
                            <div class="form-input" style="background: rgba(255,255,255,0.1); border-color: var(--accent);">
                                <i class="fas fa-calendar-check" style="color: var(--accent); margin-right: 10px;"></i>
                                {{ $destination->travel_date ? \Carbon\Carbon::parse($destination->travel_date)->format('d F Y') : 'Contact for Schedule' }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Number of Travelers</label>
                            <input type="number" name="travelers" class="form-input" value="1" min="1">
                        </div>
                        <button type="submit" class="btn btn-primary booking-btn">Konfirmasi Pesanan</button>
                    </form>
                    
                    <p style="text-align: center; font-size: 0.8rem; margin-top: 20px; opacity: 0.5;">* DP payment of 30% required for confirmation.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col">
                    <a href="{{ url('/') }}" class="logo">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" style="filter: brightness(0) invert(1); max-height: 80px;">
                    </a>
                    <p style="color: rgba(255,255,255,0.5); font-size: 0.95rem; margin-top: 30px;">Redefining the art of discovery with curated luxury and authentic local immersion.</p>
                </div>
                <div class="footer-col">
                    <h4>Exploration</h4>
                    <ul class="footer-links">
                        <li><a href="{{ url('/destinations') }}">New Destinations</a></li>
                        <li><a href="{{ route('special-offers') }}">Special Offers</a></li>
                        <li><a href="#">Cultural Heritage</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Company</h4>
                    <ul class="footer-links">
                        <li><a href="{{ route('about') }}">Our Story</a></li>
                        <li><a href="#">Privacy Ethics</a></li>
                        <li><a href="{{ url('/#contact') }}">Contact Us</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Reach Us</h4>
                    <div style="color: rgba(255,255,255,0.5); font-size: 0.9rem;">
                        <p style="margin-bottom: 15px;"><i class="fas fa-map-marker-alt" style="color: var(--accent); margin-right: 12px;"></i> Sudirman CBD, Jakarta</p>
                        <p><i class="fas fa-envelope" style="color: var(--accent); margin-right: 12px;"></i> hello@travelingin.id</p>
                    </div>
                </div>
            </div>
            <div style="text-align: center; color: rgba(255,255,255,0.3); padding-top: 40px; border-top: 1px solid rgba(255,255,255,0.05); font-size: 0.85rem;">
                <p>&copy; 2026 Travelingin.id. Elevating global exploration.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 1000, once: true, offset: 50 });
    </script>
    @include('components.booking-modal')
</body>
</html>

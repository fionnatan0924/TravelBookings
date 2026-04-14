<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Passenger Details - Travelio Combo</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #f3f6fc; padding: 2rem; }
        .container { max-width: 800px; margin: 0 auto; }
        .card { background: white; border-radius: 1.5rem; padding: 2rem; box-shadow: 0 8px 20px rgba(0,0,0,0.08); }
        h1 { font-size: 1.8rem; margin-bottom: 1.5rem; }
        .passenger-section { margin-bottom: 2rem; border-bottom: 1px solid #e2e8f0; padding-bottom: 1rem; }
        h2 { font-size: 1.3rem; margin-bottom: 1rem; color: #1f4b6e; }
        .form-row { display: flex; gap: 1rem; margin-bottom: 1rem; flex-wrap: wrap; }
        .form-group { flex: 1; min-width: 180px; }
        label { display: block; font-size: 0.8rem; font-weight: 600; margin-bottom: 0.3rem; color: #4a627a; }
        input, select { width: 100%; padding: 0.6rem; border: 1px solid #cbd5e1; border-radius: 12px; font-family: inherit; }
        button { background: linear-gradient(105deg, #0f2b3d, #1f4b6e); color: white; border: none; padding: 0.8rem; border-radius: 40px; font-weight: 700; width: 100%; margin-top: 1rem; cursor: pointer; }
        .error { color: #e53e3e; font-size: 0.75rem; margin-top: 0.2rem; }
    </style>
</head>
<body>
<div class="container">
    <div class="card">
        <h1><i class="fa-regular fa-id-card"></i> Combo Passenger Information</h1>
        <form method="POST" action="{{ route('combo.processPassengers') }}">
            @csrf
            <input type="hidden" name="adults_count" value="{{ $adults }}">
            <input type="hidden" name="children_count" value="{{ $children }}">
            <input type="hidden" name="infants_count" value="{{ $infants }}">

            @for ($i = 1; $i <= $adults; $i++)
                <div class="passenger-section">
                    <h2>Adult {{ $i }}</h2>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Full Name (as in passport)</label>
                            <input type="text" name="adult_{{ $i }}[full_name]" required>
                        </div>
                        <div class="form-group">
                            <label>Date of Birth</label>
                            <input type="date" name="adult_{{ $i }}[dob]" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Nationality</label>
                            <input type="text" name="adult_{{ $i }}[nationality]" required>
                        </div>
                        <div class="form-group">
                            <label>Passport Number (9 characters)</label>
                            <input type="text" name="adult_{{ $i }}[passport]" pattern="[A-Z0-9]{9}" required>
                        </div>
                    </div>
                </div>
            @endfor

            @for ($i = 1; $i <= $children; $i++)
                <div class="passenger-section">
                    <h2>Child {{ $i }}</h2>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" name="child_{{ $i }}[full_name]" required>
                        </div>
                        <div class="form-group">
                            <label>Date of Birth</label>
                            <input type="date" name="child_{{ $i }}[dob]" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Nationality</label>
                            <input type="text" name="child_{{ $i }}[nationality]" required>
                        </div>
                        <div class="form-group">
                            <label>Passport Number (optional)</label>
                            <input type="text" name="child_{{ $i }}[passport]" pattern="[A-Z0-9]{9}">
                        </div>
                    </div>
                </div>
            @endfor

            @for ($i = 1; $i <= $infants; $i++)
                <div class="passenger-section">
                    <h2>Infant {{ $i }}</h2>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" name="infant_{{ $i }}[full_name]" required>
                        </div>
                        <div class="form-group">
                            <label>Date of Birth</label>
                            <input type="date" name="infant_{{ $i }}[dob]" required>
                        </div>
                    </div>
                </div>
            @endfor

            <button type="submit">Confirm Combo Booking</button>
        </form>
    </div>
</div>
</body>
</html>
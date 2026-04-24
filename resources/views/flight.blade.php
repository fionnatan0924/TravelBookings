<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Travelio | Smart Flight Search</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
            background: linear-gradient(#FCF7F4);
            min-height: 100vh;
            padding: 2rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .flight-card {
            max-width: 920px;
            width: 100%;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.98);
            border-radius: 2rem;
            box-shadow: 0 20px 35px -12px rgba(0, 0, 0, 0.15);
            overflow: hidden;
        }

        .card-header {
            background: #ffffff;
            padding: 1.5rem 2rem 0.75rem 2rem;
            border-bottom: 1px solid #eef2f6;
        }

        .card-header h2 {
            font-size: 1.75rem;
            font-weight: 700;
            background: linear-gradient(135deg, #1a2a3f, #1e3a5f);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .form-container {
            padding: 1.8rem 2rem 2.2rem 2rem;
        }

        .trip-type-group {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            margin-bottom: 2rem;
            background: #f8fafc;
            padding: 0.5rem;
            border-radius: 60px;
            width: fit-content;
        }

        .trip-option {
            position: relative;
        }

        .trip-option input {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .trip-option label {
            display: inline-block;
            padding: 0.6rem 1.5rem;
            font-weight: 600;
            font-size: 0.9rem;
            border-radius: 40px;
            background: transparent;
            color: #4a5b6e;
            cursor: pointer;
            transition: all 0.2s;
        }

        .trip-option input:checked + label {
            background: #ffffff;
            color: #0f2b3d;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            font-weight: 700;
        }

        .input-group {
            margin-bottom: 1.5rem;
        }

        .input-row {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            margin-bottom: 1rem;
        }

        .input-row .field {
            flex: 1;
            min-width: 140px;
        }

        label {
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #4b6b8f;
            display: block;
            margin-bottom: 0.5rem;
        }

        .input-icon {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon i {
            position: absolute;
            left: 14px;
            color: #8aa0b5;
            font-size: 0.95rem;
            pointer-events: none;
        }

        input, select {
            width: 100%;
            padding: 0.85rem 1rem 0.85rem 2.5rem;
            font-size: 0.95rem;
            font-family: 'Inter', monospace;
            border: 1.5px solid #e2e8f0;
            border-radius: 16px;
            background: #ffffff;
            transition: all 0.2s;
            outline: none;
            color: #1e2f3e;
            font-weight: 500;
        }

        select {
            padding-left: 2.5rem;
            appearance: none;
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="%23647b92" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>');
            background-repeat: no-repeat;
            background-position: right 1rem center;
        }

        input:focus, select:focus {
            border-color: #2c6e9e;
            box-shadow: 0 0 0 3px rgba(44, 110, 158, 0.15);
        }

        /* error styles */
        input.error-field, select.error-field {
            border-color: #e53e3e;
            background-color: #fff5f5;
        }

        .error-message {
            font-size: 0.7rem;
            color: #e53e3e;
            margin-top: 0.3rem;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .passenger-grid {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .passenger-grid .field {
            flex: 1;
        }

        .passenger-label {
            font-size: 0.75rem;
            font-weight: 600;
            color: #2c5a7a;
            margin-bottom: 0.3rem;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .passenger-label span {
            font-weight: normal;
            color: #6c8eae;
            font-size: 0.7rem;
        }

        .multi-city-panel {
            background: #fefefe;
            border-radius: 1.2rem;
            padding: 0.2rem 0 0.5rem 0;
            margin-top: 0.25rem;
        }

        .segment-card {
            background: #fafcff;
            border: 1px solid #eef2f8;
            border-radius: 1.2rem;
            padding: 1rem;
            margin-bottom: 1rem;
            transition: all 0.2s;
        }

        .segment-card.error-segment {
            border-color: #e53e3e;
            background-color: #fff5f5;
        }

        .segment-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.75rem;
            font-size: 0.75rem;
            font-weight: 600;
            color: #2c6e9e;
        }

        .segment-remove {
            background: none;
            border: none;
            color: #b91c1c;
            cursor: pointer;
            font-size: 1rem;
            padding: 4px 8px;
            border-radius: 30px;
        }

        .segment-remove:hover {
            background: #fee2e2;
        }

        .add-segment-btn {
            background: transparent;
            border: 1.5px dashed #bbd4e8;
            padding: 0.7rem;
            width: 100%;
            border-radius: 60px;
            font-weight: 600;
            color: #2c6e9e;
            cursor: pointer;
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .add-segment-btn:hover {
            background: #eef6fc;
            border-color: #2c6e9e;
        }

        button.primary-btn {
            width: 100%;
            background: linear-gradient(105deg, #0f2b3d 0%, #1f4b6e 100%);
            border: none;
            padding: 1rem;
            border-radius: 40px;
            font-size: 1rem;
            font-weight: 700;
            color: white;
            cursor: pointer;
            margin-top: 1.2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            box-shadow: 0 6px 14px rgba(0, 20, 40, 0.15);
        }

        button.primary-btn:hover {
            transform: translateY(-2px);
            background: linear-gradient(105deg, #1a3a52, #28638b);
        }

        hr {
            margin: 1rem 0;
            border: 0;
            height: 1px;
            background: #eef2f8;
        }

        .hidden {
            display: none;
        }

        @media (max-width: 680px) {
            .form-container { padding: 1.5rem; }
            .input-row { flex-direction: column; gap: 1rem; }
            .passenger-grid { flex-direction: column; }
        }
    </style>
</head>
<body>
@if(session()->has('flight_searches') && count(session('flight_searches')) > 0)
<div style="margin-top: 2rem; background: #f0f4f9; padding: 1rem; border-radius: 1rem;">
    <h4 style="margin-bottom: 0.75rem; color: #1e2f3e;">
        <i class="fa-regular fa-clock"></i> Recent searches
    </h4>
    <ul style="list-style: none; padding: 0; margin: 0;">
        @foreach(session('flight_searches') as $search)
        <li style="margin-bottom: 0.75rem; padding-bottom: 0.5rem; border-bottom: 1px solid #e2e8f0; font-size: 0.85rem;">
            <div style="font-weight: 600;">{{ $search['from'] }} → {{ $search['to'] }}</div>
            <div style="color: #5b7e9c;">
                {{ $search['departure_date'] }} • {{ ucfirst($search['class']) }} • {{ $search['adults'] }} adult(s)
                <small style="display: block; margin-top: 4px;">{{ $search['searched_at'] }}</small>
            </div>
        </li>
        @endforeach
    </ul>
</div>
@endif
<div class="flight-card">
    <div class="card-header">
        <h2><i class="fa-solid fa-plane-departure"></i> Travelio</h2>
        <p style="font-size: 0.85rem; color: #5b7e9c; margin-top: 6px;">Smart search · best routes</p>
    </div>
    <div class="form-container">
    <form id="flightSearchForm" action="{{ route('flights.results') }}" method="POST" novalidate>
            @csrf

            <div class="trip-type-group">
                <div class="trip-option">
                    <input type="radio" name="trip_type" id="trip_oneway" value="oneway" checked>
                    <label for="trip_oneway"><i class="fa-solid fa-arrow-right"></i> One Way</label>
                </div>
                <div class="trip-option">
                    <input type="radio" name="trip_type" id="trip_round" value="round">
                    <label for="trip_round"><i class="fa-solid fa-arrow-right-arrow-left"></i> Return</label>
                </div>
                <div class="trip-option">
                    <input type="radio" name="trip_type" id="trip_multi" value="multi">
                    <label for="trip_multi"><i class="fa-solid fa-layer-group"></i> Multi-city</label>
                </div>
            </div>

            <div id="standardFields">
            <div class="field">
    <label><i class="fa-solid fa-location-dot"></i> From</label>
    <div class="input-icon">
        <i class="fa-solid fa-city"></i>
        <select name="from" id="originInput" class="destination-select">
            <option value="">Select departure city</option>
            @foreach($destinations as $city => $code)
                <option value="{{ $code }}">{{ $city }} ({{ $code }})</option>
            @endforeach
        </select>
    </div>
    <div class="error-message" id="originError"></div>
</div>
<div class="field">
    <label><i class="fa-solid fa-location-arrow"></i> To</label>
    <div class="input-icon">
        <i class="fa-solid fa-map-pin"></i>
        <select name="to" id="destInput" class="destination-select">
            <option value="">Select arrival city</option>
            @foreach($destinations as $city => $code)
                <option value="{{ $code }}">{{ $city }} ({{ $code }})</option>
            @endforeach
        </select>
    </div>
    <div class="error-message" id="destError"></div>
</div>
                <div class="input-row">
                    <div class="field">
                        <label><i class="fa-regular fa-calendar"></i> Departure</label>
                        <div class="input-icon">
                            <i class="fa-regular fa-calendar-check"></i>
                            <input type="date" name="departure_date" id="departureDate">
                        </div>
                        <div class="error-message" id="departureError"></div>
                    </div>
                    <div class="field" id="returnDateContainer" style="display: none;">
                        <label><i class="fa-regular fa-calendar-plus"></i> Return</label>
                        <div class="input-icon">
                            <i class="fa-regular fa-calendar-alt"></i>
                            <input type="date" name="return_date" id="returnDate">
                        </div>
                        <div class="error-message" id="returnError"></div>
                    </div>
                </div>
            </div>

            <div id="multiCityPanel" class="multi-city-panel hidden">
                <div id="segmentsContainer"></div>
                <button type="button" id="addSegmentBtn" class="add-segment-btn">
                    <i class="fa-solid fa-plus-circle"></i> Add another flight
                </button>
                <div id="multiCityGlobalError" class="error-message" style="display: none;"></div>
            </div>

            <hr>

            <div class="input-row">
                <div class="field">
                    <label><i class="fa-solid fa-crown"></i> Cabin class</label>
                    <div class="input-icon">
                        <i class="fa-solid fa-chair"></i>
                        <select name="class" id="cabinClass">
                            <option value="economy">Economy</option>
                            <option value="premium">Premium Economy</option>
                            <option value="business">Business</option>
                            <option value="first">First Class</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="input-group">
                <label><i class="fa-solid fa-users"></i> Passengers</label>
                <div class="passenger-grid">
                    <div class="field">
                        <div class="passenger-label">Adults <span>(12+ yrs)</span></div>
                        <div class="input-icon">
                            <i class="fa-solid fa-user"></i>
                            <input type="number" name="adults" id="adults" min="1" max="9" value="1">
                        </div>
                        <div class="error-message" id="adultsError"></div>
                    </div>
                    <div class="field">
                        <div class="passenger-label">Children <span>(2-11 yrs)</span></div>
                        <div class="input-icon">
                            <i class="fa-solid fa-child"></i>
                            <input type="number" name="children" id="children" min="0" max="6" value="0">
                        </div>
                    </div>
                    <div class="field">
                        <div class="passenger-label">Infants <span>(under 2 yrs)</span></div>
                        <div class="input-icon">
                            <i class="fa-solid fa-baby"></i>
                            <input type="number" name="infants" id="infants" min="0" max="4" value="0">
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="primary-btn">
                <i class="fa-solid fa-magnifying-glass"></i> Search Flights
            </button>
        </form>
    </div>
</div>

<script>
    (function() {
        const form = document.getElementById('flightSearchForm');
        const tripOneway = document.getElementById('trip_oneway');
        const tripRound = document.getElementById('trip_round');
        const tripMulti = document.getElementById('trip_multi');
        const standardDiv = document.getElementById('standardFields');
        const multiPanel = document.getElementById('multiCityPanel');
        const returnContainer = document.getElementById('returnDateContainer');
        const departureDateInput = document.getElementById('departureDate');
        const returnDateInput = document.getElementById('returnDate');
        const originInput = document.getElementById('originInput');
        const destInput = document.getElementById('destInput');
        const adultsInput = document.getElementById('adults');
        const childrenInput = document.getElementById('children');
        const infantsInput = document.getElementById('infants');
        const segmentsContainer = document.getElementById('segmentsContainer');
        const addSegmentBtn = document.getElementById('addSegmentBtn');
        const multiCityGlobalError = document.getElementById('multiCityGlobalError');

        // Helper: clear error for a specific field
        function clearFieldError(fieldId, errorId) {
            const field = document.getElementById(fieldId);
            const errorDiv = document.getElementById(errorId);
            if (field) field.classList.remove('error-field');
            if (errorDiv) errorDiv.innerHTML = '';
        }

        function setFieldError(fieldId, errorId, message) {
            const field = document.getElementById(fieldId);
            const errorDiv = document.getElementById(errorId);
            if (field) field.classList.add('error-field');
            if (errorDiv) errorDiv.innerHTML = `<i class="fa-solid fa-circle-exclamation"></i> ${message}`;
        }

        // Clear all standard errors
        function clearStandardErrors() {
            clearFieldError('originInput', 'originError');
            clearFieldError('destInput', 'destError');
            clearFieldError('departureDate', 'departureError');
            clearFieldError('returnDate', 'returnError');
        }

        // Validate standard (oneway/round) – called only on submit
        function validateStandard() {
            let isValid = true;
            clearStandardErrors();

            const origin = originInput.value.trim();
            if (!origin) {
                setFieldError('originInput', 'originError', 'Departure city is required');
                isValid = false;
            }
            const dest = destInput.value.trim();
            if (!dest) {
                setFieldError('destInput', 'destError', 'Arrival city is required');
                isValid = false;
            }
            if (origin && dest && origin.toLowerCase() === dest.toLowerCase()) {
                setFieldError('destInput', 'destError', 'Origin and destination cannot be the same');
                isValid = false;
            }

            const depDate = departureDateInput.value;
            const today = new Date().toISOString().split('T')[0];
            if (!depDate) {
                setFieldError('departureDate', 'departureError', 'Departure date is required');
                isValid = false;
            } else if (depDate < today) {
                setFieldError('departureDate', 'departureError', 'Departure date cannot be in the past');
                isValid = false;
            }

            if (tripRound.checked) {
                const retDate = returnDateInput.value;
                if (!retDate) {
                    setFieldError('returnDate', 'returnError', 'Return date is required for round trip');
                    isValid = false;
                } else if (depDate && retDate < depDate) {
                    setFieldError('returnDate', 'returnError', 'Return date cannot be before departure date');
                    isValid = false;
                }
            }
            return isValid;
        }

        // Validate multi-city segments – called only on submit
        function validateMultiCity() {
            const segments = document.querySelectorAll('#segmentsContainer .segment-card');
            let isValid = true;
            // remove previous per-segment errors
            segments.forEach(seg => {
                seg.classList.remove('error-segment');
                const existingErrors = seg.querySelectorAll('.segment-error');
                existingErrors.forEach(err => err.remove());
            });
            multiCityGlobalError.style.display = 'none';
            multiCityGlobalError.innerHTML = '';

            if (segments.length === 0) {
                multiCityGlobalError.style.display = 'flex';
                multiCityGlobalError.innerHTML = '<i class="fa-solid fa-circle-exclamation"></i> At least one flight segment is required';
                return false;
            }

            const today = new Date().toISOString().split('T')[0];
            for (let i = 0; i < segments.length; i++) {
                const seg = segments[i];
                const fromInput = seg.querySelector('.segment-from');
                const toInput = seg.querySelector('.segment-to');
                const dateInput = seg.querySelector('.segment-date');
                let segmentValid = true;

                const fromVal = fromInput?.value.trim() || '';
                const toVal = toInput?.value.trim() || '';
                const dateVal = dateInput?.value || '';

                if (!fromVal) {
                    segmentValid = false;
                    showSegmentError(seg, 'Origin is required');
                } else if (!toVal) {
                    segmentValid = false;
                    showSegmentError(seg, 'Destination is required');
                } else if (fromVal.toLowerCase() === toVal.toLowerCase()) {
                    segmentValid = false;
                    showSegmentError(seg, 'Origin and destination cannot be the same');
                } else if (!dateVal) {
                    segmentValid = false;
                    showSegmentError(seg, 'Flight date is required');
                } else if (dateVal < today) {
                    segmentValid = false;
                    showSegmentError(seg, 'Date cannot be in the past');
                }

                if (!segmentValid) {
                    seg.classList.add('error-segment');
                    isValid = false;
                }
            }
            if (!isValid) {
                multiCityGlobalError.style.display = 'flex';
                multiCityGlobalError.innerHTML = '<i class="fa-solid fa-circle-exclamation"></i> Please correct errors in flight segments';
            }
            return isValid;
        }

        function showSegmentError(segment, message) {
            let errorDiv = segment.querySelector('.segment-error');
            if (!errorDiv) {
                errorDiv = document.createElement('div');
                errorDiv.className = 'error-message segment-error';
                segment.appendChild(errorDiv);
            }
            errorDiv.innerHTML = `<i class="fa-solid fa-circle-exclamation"></i> ${message}`;
        }

        // Validate passengers (at least one adult)
        function validatePassengers() {
            const adults = parseInt(adultsInput.value);
            if (isNaN(adults) || adults < 1) {
                setFieldError('adults', 'adultsError', 'At least one adult passenger is required');
                return false;
            } else {
                clearFieldError('adults', 'adultsError');
                return true;
            }
        }

        // Clear all errors (used when trip type changes)
        function clearAllErrors() {
            clearStandardErrors();
            clearFieldError('adults', 'adultsError');
            multiCityGlobalError.style.display = 'none';
            const segments = document.querySelectorAll('#segmentsContainer .segment-card');
            segments.forEach(seg => {
                seg.classList.remove('error-segment');
                const err = seg.querySelector('.segment-error');
                if (err) err.remove();
            });
        }

        // --- Live error clearing when user types / changes a field ---
        function attachLiveErrorClearing() {
            // Standard fields
            originInput.addEventListener('input', () => clearFieldError('originInput', 'originError'));
            destInput.addEventListener('input', () => clearFieldError('destInput', 'destError'));
            departureDateInput.addEventListener('change', () => clearFieldError('departureDate', 'departureError'));
            returnDateInput.addEventListener('change', () => clearFieldError('returnDate', 'returnError'));
            adultsInput.addEventListener('input', () => clearFieldError('adults', 'adultsError'));

            // For multi-city: we'll use event delegation on segments container
            segmentsContainer.addEventListener('input', (e) => {
                if (e.target.classList && (e.target.classList.contains('segment-from') || e.target.classList.contains('segment-to') || e.target.classList.contains('segment-date'))) {
                    const segmentCard = e.target.closest('.segment-card');
                    if (segmentCard) {
                        segmentCard.classList.remove('error-segment');
                        const errDiv = segmentCard.querySelector('.segment-error');
                        if (errDiv) errDiv.remove();
                        multiCityGlobalError.style.display = 'none';
                    }
                }
            });
        }

        // --- Trip type switching logic ---
        function toggleTripType() {
            const isMulti = tripMulti.checked;
            const isRound = tripRound.checked;
            clearAllErrors();

            if (isMulti) {
                standardDiv.classList.add('hidden');
                multiPanel.classList.remove('hidden');
                disableStandardFields(true);
                enableMultiSegments(true);
                if (segmentsContainer.children.length === 0) initMultiCitySegments();
            } else {
                standardDiv.classList.remove('hidden');
                multiPanel.classList.add('hidden');
                disableStandardFields(false);
                enableMultiSegments(false);
                if (isRound) {
                    returnContainer.style.display = 'block';
                    returnDateInput.required = true;
                } else {
                    returnContainer.style.display = 'none';
                    returnDateInput.required = false;
                }
            }
            if (!isMulti && isRound) {
                returnContainer.style.display = 'block';
                returnDateInput.required = true;
            } else if (!isMulti) {
                returnContainer.style.display = 'none';
                returnDateInput.required = false;
            }

            if (!isMulti) {
                departureDateInput.required = true;
                originInput.required = true;
                destInput.required = true;
                if (isRound) returnDateInput.required = true;
                else returnDateInput.required = false;
            } else {
                departureDateInput.required = false;
                originInput.required = false;
                destInput.required = false;
                returnDateInput.required = false;
            }
        }

        function disableStandardFields(disabled) {
            originInput.disabled = disabled;
            destInput.disabled = disabled;
            departureDateInput.disabled = disabled;
            returnDateInput.disabled = disabled;
            if (disabled) {
                originInput.removeAttribute('required');
                destInput.removeAttribute('required');
                departureDateInput.removeAttribute('required');
                returnDateInput.removeAttribute('required');
            } else {
                if (!disabled && tripRound.checked) returnDateInput.setAttribute('required', 'required');
                if (!disabled) departureDateInput.setAttribute('required', 'required');
                if (!disabled) { originInput.setAttribute('required', 'required'); destInput.setAttribute('required', 'required'); }
            }
        }

        function enableMultiSegments(enabled) {
            const allSegFrom = document.querySelectorAll('#segmentsContainer .segment-from');
            const allSegTo = document.querySelectorAll('#segmentsContainer .segment-to');
            const allSegDate = document.querySelectorAll('#segmentsContainer .segment-date');
            allSegFrom.forEach(inp => inp.disabled = !enabled);
            allSegTo.forEach(inp => inp.disabled = !enabled);
            allSegDate.forEach(inp => inp.disabled = !enabled);
            if (enabled) {
                allSegFrom.forEach(inp => inp.setAttribute('required', 'required'));
                allSegTo.forEach(inp => inp.setAttribute('required', 'required'));
                allSegDate.forEach(inp => inp.setAttribute('required', 'required'));
            } else {
                allSegFrom.forEach(inp => inp.removeAttribute('required'));
                allSegTo.forEach(inp => inp.removeAttribute('required'));
                allSegDate.forEach(inp => inp.removeAttribute('required'));
            }
        }

        // --- Multi-city dynamic segment management ---
        function createSegmentRow(index, withRemove = true, prefill = { from: '', to: '', date: '' }) {
            const segmentDiv = document.createElement('div');
            segmentDiv.className = 'segment-card';
            segmentDiv.dataset.index = index;
            const headerDiv = document.createElement('div');
            headerDiv.className = 'segment-header';
            headerDiv.innerHTML = `<span><i class="fa-solid fa-map-location-dot"></i> Flight ${index+1}</span>`;
            if (withRemove) {
                const removeBtn = document.createElement('button');
                removeBtn.type = 'button';
                removeBtn.className = 'segment-remove';
                removeBtn.innerHTML = '<i class="fa-regular fa-trash-can"></i> Remove';
                removeBtn.onclick = () => {
                    segmentDiv.remove();
                    reindexSegments();
                };
                headerDiv.appendChild(removeBtn);
            }
            segmentDiv.appendChild(headerDiv);
            const rowDiv = document.createElement('div');
            rowDiv.className = 'input-row';
            const fromField = document.createElement('div');
            fromField.className = 'field';
            fromField.innerHTML = `<label><i class="fa-solid fa-plane-departure"></i> From</label>
                                   <div class="input-icon"><i class="fa-solid fa-building"></i>
                                   <input type="text" class="segment-from" placeholder="City / Airport" value="${escapeHtml(prefill.from)}"></div>`;
            const toField = document.createElement('div');
            toField.className = 'field';
            toField.innerHTML = `<label><i class="fa-solid fa-plane-arrival"></i> To</label>
                                 <div class="input-icon"><i class="fa-solid fa-location-dot"></i>
                                 <input type="text" class="segment-to" placeholder="Destination" value="${escapeHtml(prefill.to)}"></div>`;
            const dateField = document.createElement('div');
            dateField.className = 'field';
            dateField.innerHTML = `<label><i class="fa-regular fa-calendar"></i> Date</label>
                                   <div class="input-icon"><i class="fa-regular fa-calendar-check"></i>
                                   <input type="date" class="segment-date" value="${prefill.date || ''}"></div>`;
            const dateInputElem = dateField.querySelector('.segment-date');
            const today = new Date().toISOString().split('T')[0];
            if (dateInputElem) dateInputElem.min = today;

            rowDiv.appendChild(fromField);
            rowDiv.appendChild(toField);
            rowDiv.appendChild(dateField);
            segmentDiv.appendChild(rowDiv);
            return segmentDiv;
        }

        function escapeHtml(str) { if(!str) return ''; return str.replace(/[&<>]/g, function(m){if(m==='&') return '&amp;'; if(m==='<') return '&lt;'; if(m==='>') return '&gt;'; return m;});}

        function reindexSegments() {
            const segments = document.querySelectorAll('#segmentsContainer .segment-card');
            segments.forEach((seg, idx) => {
                seg.dataset.index = idx;
                const headerSpan = seg.querySelector('.segment-header span');
                if (headerSpan) headerSpan.innerHTML = `<i class="fa-solid fa-map-location-dot"></i> Flight ${idx+1}`;
                const removeBtn = seg.querySelector('.segment-remove');
                if (removeBtn && segments.length === 1) {
                    removeBtn.style.display = 'none';
                } else if (removeBtn) {
                    removeBtn.style.display = 'inline-flex';
                }
            });
        }

        function initMultiCitySegments() {
            segmentsContainer.innerHTML = '';
            const firstSegment = createSegmentRow(0, false);
            segmentsContainer.appendChild(firstSegment);
            reindexSegments();
        }

        function addSegment() {
            const currentCount = document.querySelectorAll('#segmentsContainer .segment-card').length;
            if (currentCount >= 6) {
                alert('Maximum 6 flight segments allowed');
                return;
            }
            const newSegment = createSegmentRow(currentCount, true);
            segmentsContainer.appendChild(newSegment);
            reindexSegments();
        }

        // --- FORM SUBMIT: only here we validate and show errors ---
        form.addEventListener('submit', function(e) {
            let isValid = false;
            if (tripMulti.checked) {
                isValid = validateMultiCity() && validatePassengers();
            } else {
                isValid = validateStandard() && validatePassengers();
            }
            if (!isValid) {
                e.preventDefault();
                const firstError = document.querySelector('.error-message:not(:empty)');
                if (firstError) firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                return;
            }

            // Prepare data for submission (multi-city vs standard)
            const existingMultiInputs = form.querySelectorAll('input[name^="multi_segments"]');
            existingMultiInputs.forEach(el => el.remove());

            if (tripMulti.checked) {
                originInput.name = '';
                destInput.name = '';
                departureDateInput.name = '';
                returnDateInput.name = '';
                const segments = document.querySelectorAll('#segmentsContainer .segment-card');
                for (let i=0; i<segments.length; i++) {
                    const fromVal = segments[i].querySelector('.segment-from').value.trim();
                    const toVal = segments[i].querySelector('.segment-to').value.trim();
                    const dateVal = segments[i].querySelector('.segment-date').value;
                    const fromHidden = document.createElement('input');
                    fromHidden.type = 'hidden';
                    fromHidden.name = `multi_segments[${i}][from]`;
                    fromHidden.value = fromVal;
                    const toHidden = document.createElement('input');
                    toHidden.type = 'hidden';
                    toHidden.name = `multi_segments[${i}][to]`;
                    toHidden.value = toVal;
                    const dateHidden = document.createElement('input');
                    dateHidden.type = 'hidden';
                    dateHidden.name = `multi_segments[${i}][date]`;
                    dateHidden.value = dateVal;
                    form.appendChild(fromHidden);
                    form.appendChild(toHidden);
                    form.appendChild(dateHidden);
                }
                const multiTypeHint = document.createElement('input');
                multiTypeHint.type = 'hidden';
                multiTypeHint.name = 'is_multi_city';
                multiTypeHint.value = '1';
                form.appendChild(multiTypeHint);
            } else {
                originInput.name = 'from';
                destInput.name = 'to';
                departureDateInput.name = 'departure_date';
                if (tripRound.checked) returnDateInput.name = 'return_date';
                else returnDateInput.name = '';
            }
        });

        // Event listeners
        tripOneway.addEventListener('change', toggleTripType);
        tripRound.addEventListener('change', toggleTripType);
        tripMulti.addEventListener('change', toggleTripType);
        addSegmentBtn.addEventListener('click', addSegment);
        attachLiveErrorClearing();

        // Initial setup
        const today = new Date().toISOString().split('T')[0];
        departureDateInput.min = today;
        if (returnDateInput) returnDateInput.min = today;
        initMultiCitySegments();
        enableMultiSegments(false);
        toggleTripType();  // sets one-way as active
    })();
</script>
</body>
</html>
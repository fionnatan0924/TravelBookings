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

        // Helper functions
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

        function clearStandardErrors() {
            clearFieldError('originInput', 'originError');
            clearFieldError('destInput', 'destError');
            clearFieldError('departureDate', 'departureError');
            clearFieldError('returnDate', 'returnError');
        }

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

        function showSegmentError(segment, message) {
            let errorDiv = segment.querySelector('.segment-error');
            if (!errorDiv) {
                errorDiv = document.createElement('div');
                errorDiv.className = 'error-message segment-error';
                segment.appendChild(errorDiv);
            }
            errorDiv.innerHTML = `<i class="fa-solid fa-circle-exclamation"></i> ${message}`;
        }

        function validateMultiCity() {
            const segments = document.querySelectorAll('#segmentsContainer .segment-card');
            let isValid = true;
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

        function attachLiveErrorClearing() {
            originInput.addEventListener('input', () => clearFieldError('originInput', 'originError'));
            destInput.addEventListener('input', () => clearFieldError('destInput', 'destError'));
            departureDateInput.addEventListener('change', () => clearFieldError('departureDate', 'departureError'));
            returnDateInput.addEventListener('change', () => clearFieldError('returnDate', 'returnError'));
            adultsInput.addEventListener('input', () => clearFieldError('adults', 'adultsError'));

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

        // Event listeners
        tripOneway.addEventListener('change', toggleTripType);
        tripRound.addEventListener('change', toggleTripType);
        tripMulti.addEventListener('change', toggleTripType);
        addSegmentBtn.addEventListener('click', addSegment);
        attachLiveErrorClearing();

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

        const today = new Date().toISOString().split('T')[0];
        departureDateInput.min = today;
        if (returnDateInput) returnDateInput.min = today;
        initMultiCitySegments();
        enableMultiSegments(false);
        toggleTripType();
    })();
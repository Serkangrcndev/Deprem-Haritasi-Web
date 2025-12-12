<div class="main-content">
    <div class="parent">
        <div class="div1 map-section">
            <div class="map-container">
                <div id="earthquakeMap"></div>
                <div class="map-legend">
                    <h4>Derinlik Göstergesi (km)</h4>
                    <div class="legend-items">
                        <div class="legend-item">
                            <span class="legend-color" style="background: #8B0000;"></span>
                            <span>d≥0 d≤5</span>
                        </div>
                        <div class="legend-item">
                            <span class="legend-color" style="background: #FF0000;"></span>
                            <span>d>5 d≤10</span>
                        </div>
                        <div class="legend-item">
                            <span class="legend-color" style="background: #FF8C00;"></span>
                            <span>d>10 d≤20</span>
                        </div>
                        <div class="legend-item">
                            <span class="legend-color" style="background: #FFD700;"></span>
                            <span>d>20 d≤40</span>
                        </div>
                        <div class="legend-item">
                            <span class="legend-color" style="background: #90EE90;"></span>
                            <span>d>40 d≤80</span>
                        </div>
                        <div class="legend-item">
                            <span class="legend-color" style="background: #00CED1;"></span>
                            <span>d>80 d≤150</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="div2 controls-section">
            <div class="filters-panel">
                <div class="filter-group">
                    <label for="cityFilterTrigger">
                        <i class="fas fa-city"></i> Şehir Filtrele
                    </label>
                    <div class="custom-select-wrapper">
                        <div class="custom-select-trigger" id="cityFilterTrigger">
                            <span id="cityFilterText">Tüm Şehirler</span>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="custom-select-dropdown" id="cityFilterDropdown">
                            <div class="custom-select-search">
                                <i class="fas fa-search"></i>
                                <input type="text" id="cityFilterSearch" placeholder="Şehir ara..." autocomplete="off">
                            </div>
                            <div class="custom-select-options" id="cityFilterOptions">
                                <div class="custom-select-option" data-value="">Tüm Şehirler</div>
                        <?php foreach($turkey_cities as $city): ?>
                                    <div class="custom-select-option" data-value="<?php echo htmlspecialchars($city); ?>"><?php echo htmlspecialchars($city); ?></div>
                        <?php endforeach; ?>
                            </div>
                        </div>
                        <input type="hidden" id="cityFilter" value="">
                    </div>
                </div>
                
                <div class="filter-group">
                    <label for="magnitudeFilterTrigger">
                        <i class="fas fa-chart-line"></i> Minimum Büyüklük
                    </label>
                    <div class="custom-select-wrapper">
                        <div class="custom-select-trigger" id="magnitudeFilterTrigger">
                            <span id="magnitudeFilterText">Tümü</span>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="custom-select-dropdown" id="magnitudeFilterDropdown">
                            <div class="custom-select-options" id="magnitudeFilterOptions">
                                <div class="custom-select-option" data-value="0">Tümü</div>
                                <div class="custom-select-option" data-value="2">2.0+</div>
                                <div class="custom-select-option" data-value="3">3.0+</div>
                                <div class="custom-select-option" data-value="4">4.0+</div>
                                <div class="custom-select-option" data-value="5">5.0+</div>
                                <div class="custom-select-option" data-value="6">6.0+</div>
                            </div>
                        </div>
                        <input type="hidden" id="magnitudeFilter" value="0">
                    </div>
                </div>
                
                <div class="filter-group">
                    <label for="timeFilterTrigger">
                        <i class="fas fa-clock"></i> Zaman Aralığı
                    </label>
                    <div class="custom-select-wrapper">
                        <div class="custom-select-trigger" id="timeFilterTrigger">
                            <span id="timeFilterText">Son 24 Saat</span>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="custom-select-dropdown" id="timeFilterDropdown">
                            <div class="custom-select-options" id="timeFilterOptions">
                                <div class="custom-select-option" data-value="hour">Son 1 Saat</div>
                                <div class="custom-select-option" data-value="day" data-selected="true">Son 24 Saat</div>
                                <div class="custom-select-option" data-value="week">Son 7 Gün</div>
                                <div class="custom-select-option" data-value="month">Son 30 Gün</div>
                            </div>
                        </div>
                        <input type="hidden" id="timeFilter" value="day">
                    </div>
                </div>
                
                <button class="btn-refresh" id="refreshBtn">
                    <i class="fas fa-sync-alt"></i> Yenile
                </button>
            </div>
            
            <div class="stats-panel" id="statsPanel">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-value" id="totalEarthquakes">0</div>
                        <div class="stat-label">Toplam Deprem</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-fire"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-value" id="maxMagnitude">0.0</div>
                        <div class="stat-label">Maksimum Büyüklük</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-value" id="lastUpdate">-</div>
                        <div class="stat-label">Son Güncelleme</div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="div3 earthquake-list-section">
            <div class="earthquake-list-container">
                <h2 class="section-title">
                    <i class="fas fa-list"></i> Son Depremler
                </h2>
                <div class="earthquake-list" id="earthquakeList">
                    <div class="loading">
                        <i class="fas fa-spinner fa-spin"></i> Veriler yükleniyor...
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let earthquakeData = [];
let map;
let markers = [];
let pulseRings = [];
let animationIds = [];

const TURKEY_BOUNDS = {
    minLat: 35.8,
    maxLat: 42.1,
    minLng: 25.7,
    maxLng: 44.8
};

let scenarioMarker = null;
let scenarioRings = [];
let scenarioAnimationIds = [];

document.addEventListener('DOMContentLoaded', function() {
    initMap();
    loadEarthquakeData();
    
    checkActiveScenario();
    
    window.addEventListener('message', function(event) {
        if (event.data.type === 'SCENARIO_START') {
            displayScenarioOnMap(event.data.data);
        } else if (event.data.type === 'SCENARIO_STOP') {
            removeScenarioFromMap();
        }
    });
    
    window.addEventListener('storage', function(event) {
        if (event.key === 'activeScenario') {
            if (event.newValue) {
                const scenarioData = JSON.parse(event.newValue);
                if (scenarioData.active) {
                    displayScenarioOnMap(scenarioData);
                }
            } else {
                removeScenarioFromMap();
            }
        }
    });
    
    document.getElementById('refreshBtn').addEventListener('click', loadEarthquakeData);
    
    initCityFilter();
    initMagnitudeFilter();
    initTimeFilter();
});

function initCityFilter() {
    const trigger = document.getElementById('cityFilterTrigger');
    const dropdown = document.getElementById('cityFilterDropdown');
    const searchInput = document.getElementById('cityFilterSearch');
    const options = document.querySelectorAll('#cityFilterOptions .custom-select-option');
    const hiddenInput = document.getElementById('cityFilter');
    const textDisplay = document.getElementById('cityFilterText');
    const wrapper = trigger.closest('.custom-select-wrapper');
    const label = document.querySelector('label[for="cityFilterTrigger"]');
    
    if (label) {
        label.addEventListener('click', function(e) {
            e.preventDefault();
            trigger.click();
        });
    }
    
    trigger.addEventListener('click', function(e) {
        e.stopPropagation();
        e.preventDefault();
        const isOpen = dropdown.classList.contains('active');
        
        document.querySelectorAll('.custom-select-dropdown').forEach(d => {
            if (d !== dropdown) {
                d.classList.remove('active');
                const dWrapper = d.closest('.custom-select-wrapper');
                if (d.parentElement !== dWrapper && dWrapper) {
                    dWrapper.appendChild(d);
                    d.style.position = '';
                    d.style.top = '';
                    d.style.left = '';
                    d.style.width = '';
                    d.style.zIndex = '';
                }
            }
        });
        
        if (!isOpen) {
            dropdown.classList.add('active');
            
            const rect = trigger.getBoundingClientRect();
            dropdown.style.position = 'fixed';
            dropdown.style.top = (rect.bottom + 8) + 'px';
            dropdown.style.left = rect.left + 'px';
            dropdown.style.width = rect.width + 'px';
            dropdown.style.zIndex = '99999';
            document.body.appendChild(dropdown);
            
            setTimeout(() => {
                searchInput.focus();
            }, 100);
        } else {
            dropdown.classList.remove('active');
            if (dropdown.parentElement !== wrapper) {
                wrapper.appendChild(dropdown);
                dropdown.style.position = '';
                dropdown.style.top = '';
                dropdown.style.left = '';
                dropdown.style.width = '';
                dropdown.style.zIndex = '';
            }
        }
    });
    
    document.addEventListener('click', function(e) {
        if (!dropdown.contains(e.target) && !trigger.contains(e.target) && !trigger.querySelector('label')) {
            dropdown.classList.remove('active');
            if (dropdown.parentElement !== wrapper) {
                wrapper.appendChild(dropdown);
                dropdown.style.position = '';
                dropdown.style.top = '';
                dropdown.style.left = '';
                dropdown.style.width = '';
                dropdown.style.zIndex = '';
            }
        }
    });
    
    let updatePosition = function() {
        if (dropdown.classList.contains('active') && dropdown.parentElement === document.body) {
            const rect = trigger.getBoundingClientRect();
            dropdown.style.top = (rect.bottom + 8) + 'px';
            dropdown.style.left = rect.left + 'px';
            dropdown.style.width = rect.width + 'px';
        }
    };
    
    window.addEventListener('scroll', updatePosition, true);
    window.addEventListener('resize', updatePosition);
    
    if (dropdown.parentElement !== wrapper) {
        wrapper.appendChild(dropdown);
        dropdown.style.position = '';
        dropdown.style.top = '';
        dropdown.style.left = '';
        dropdown.style.width = '';
        dropdown.style.zIndex = '';
    }
    
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase().trim();
        options.forEach(option => {
            const text = option.textContent.toLowerCase();
            if (text.includes(searchTerm)) {
                option.style.display = 'block';
            } else {
                option.style.display = 'none';
            }
        });
    });
    
    options.forEach(option => {
        option.addEventListener('click', function() {
            const value = this.getAttribute('data-value');
            const text = this.textContent;
            
            hiddenInput.value = value;
            textDisplay.textContent = text;
            dropdown.classList.remove('active');
            searchInput.value = '';
            
            options.forEach(opt => opt.style.display = 'block');
            
            const wrapper = document.querySelector('.custom-select-wrapper');
            if (dropdown.parentElement !== wrapper) {
                wrapper.appendChild(dropdown);
                dropdown.style.position = '';
                dropdown.style.top = '';
                dropdown.style.left = '';
                dropdown.style.width = '';
            }
            
            applyFilters();
        });
    });
    
    searchInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            const visibleOptions = Array.from(options).filter(opt => opt.style.display !== 'none');
            if (visibleOptions.length > 0) {
                visibleOptions[0].click();
            }
        }
    });
}

function initMagnitudeFilter() {
    const trigger = document.getElementById('magnitudeFilterTrigger');
    const dropdown = document.getElementById('magnitudeFilterDropdown');
    const options = document.querySelectorAll('#magnitudeFilterOptions .custom-select-option');
    const hiddenInput = document.getElementById('magnitudeFilter');
    const textDisplay = document.getElementById('magnitudeFilterText');
    const wrapper = trigger.closest('.custom-select-wrapper');
    const label = document.querySelector('label[for="magnitudeFilterTrigger"]');
    
    const initialOption = options[0];
    textDisplay.textContent = initialOption.textContent;
    hiddenInput.value = initialOption.getAttribute('data-value');
    
    if (label) {
        label.addEventListener('click', function(e) {
            e.preventDefault();
            trigger.click();
        });
    }
    
    trigger.addEventListener('click', function(e) {
        e.stopPropagation();
        e.preventDefault();
        const isOpen = dropdown.classList.contains('active');
        
        document.querySelectorAll('.custom-select-dropdown').forEach(d => {
            if (d !== dropdown) {
                d.classList.remove('active');
                const dWrapper = d.closest('.custom-select-wrapper');
                if (d.parentElement !== dWrapper && dWrapper) {
                    dWrapper.appendChild(d);
                    d.style.position = '';
                    d.style.top = '';
                    d.style.left = '';
                    d.style.width = '';
                    d.style.zIndex = '';
                }
            }
        });
        
        if (!isOpen) {
            dropdown.classList.add('active');
            
            const rect = trigger.getBoundingClientRect();
            dropdown.style.position = 'fixed';
            dropdown.style.top = (rect.bottom + 8) + 'px';
            dropdown.style.left = rect.left + 'px';
            dropdown.style.width = rect.width + 'px';
            dropdown.style.zIndex = '99999';
            document.body.appendChild(dropdown);
        } else {
            dropdown.classList.remove('active');
            if (dropdown.parentElement !== wrapper) {
                wrapper.appendChild(dropdown);
                dropdown.style.position = '';
                dropdown.style.top = '';
                dropdown.style.left = '';
                dropdown.style.width = '';
                dropdown.style.zIndex = '';
            }
        }
    });
    
    document.addEventListener('click', function(e) {
        if (!dropdown.contains(e.target) && !trigger.contains(e.target)) {
            dropdown.classList.remove('active');
            if (dropdown.parentElement !== wrapper) {
                wrapper.appendChild(dropdown);
                dropdown.style.position = '';
                dropdown.style.top = '';
                dropdown.style.left = '';
                dropdown.style.width = '';
                dropdown.style.zIndex = '';
            }
        }
    });
    
    let updatePosition = function() {
        if (dropdown.classList.contains('active') && dropdown.parentElement === document.body) {
            const rect = trigger.getBoundingClientRect();
            dropdown.style.top = (rect.bottom + 8) + 'px';
            dropdown.style.left = rect.left + 'px';
            dropdown.style.width = rect.width + 'px';
        }
    };
    
    window.addEventListener('scroll', updatePosition, true);
    window.addEventListener('resize', updatePosition);
    
    options.forEach(option => {
        option.addEventListener('click', function() {
            const value = this.getAttribute('data-value');
            const text = this.textContent;
            
            hiddenInput.value = value;
            textDisplay.textContent = text;
            dropdown.classList.remove('active');
            
            if (dropdown.parentElement !== wrapper) {
                wrapper.appendChild(dropdown);
                dropdown.style.position = '';
                dropdown.style.top = '';
                dropdown.style.left = '';
                dropdown.style.width = '';
                dropdown.style.zIndex = '';
            }
            
            applyFilters();
        });
    });
    
    if (dropdown.parentElement !== wrapper) {
        wrapper.appendChild(dropdown);
        dropdown.style.position = '';
        dropdown.style.top = '';
        dropdown.style.left = '';
        dropdown.style.width = '';
        dropdown.style.zIndex = '';
    }
}

function initTimeFilter() {
    const trigger = document.getElementById('timeFilterTrigger');
    const dropdown = document.getElementById('timeFilterDropdown');
    const options = document.querySelectorAll('#timeFilterOptions .custom-select-option');
    const hiddenInput = document.getElementById('timeFilter');
    const textDisplay = document.getElementById('timeFilterText');
    const wrapper = trigger.closest('.custom-select-wrapper');
    const label = document.querySelector('label[for="timeFilterTrigger"]');
    
    let initialOption = Array.from(options).find(opt => opt.getAttribute('data-selected') === 'true');
    if (!initialOption) initialOption = options[1];
    textDisplay.textContent = initialOption.textContent;
    hiddenInput.value = initialOption.getAttribute('data-value');
    
    if (label) {
        label.addEventListener('click', function(e) {
            e.preventDefault();
            trigger.click();
        });
    }
    
    trigger.addEventListener('click', function(e) {
        e.stopPropagation();
        e.preventDefault();
        const isOpen = dropdown.classList.contains('active');
        
        document.querySelectorAll('.custom-select-dropdown').forEach(d => {
            if (d !== dropdown) {
                d.classList.remove('active');
                const dWrapper = d.closest('.custom-select-wrapper');
                if (d.parentElement !== dWrapper && dWrapper) {
                    dWrapper.appendChild(d);
                    d.style.position = '';
                    d.style.top = '';
                    d.style.left = '';
                    d.style.width = '';
                    d.style.zIndex = '';
                }
            }
        });
        
        if (!isOpen) {
            dropdown.classList.add('active');
            
            const rect = trigger.getBoundingClientRect();
            dropdown.style.position = 'fixed';
            dropdown.style.top = (rect.bottom + 8) + 'px';
            dropdown.style.left = rect.left + 'px';
            dropdown.style.width = rect.width + 'px';
            dropdown.style.zIndex = '99999';
            document.body.appendChild(dropdown);
        } else {
            dropdown.classList.remove('active');
            if (dropdown.parentElement !== wrapper) {
                wrapper.appendChild(dropdown);
                dropdown.style.position = '';
                dropdown.style.top = '';
                dropdown.style.left = '';
                dropdown.style.width = '';
                dropdown.style.zIndex = '';
            }
        }
    });
    
    document.addEventListener('click', function(e) {
        if (!dropdown.contains(e.target) && !trigger.contains(e.target)) {
            dropdown.classList.remove('active');
            if (dropdown.parentElement !== wrapper) {
                wrapper.appendChild(dropdown);
                dropdown.style.position = '';
                dropdown.style.top = '';
                dropdown.style.left = '';
                dropdown.style.width = '';
                dropdown.style.zIndex = '';
            }
        }
    });
    
    let updatePosition = function() {
        if (dropdown.classList.contains('active') && dropdown.parentElement === document.body) {
            const rect = trigger.getBoundingClientRect();
            dropdown.style.top = (rect.bottom + 8) + 'px';
            dropdown.style.left = rect.left + 'px';
            dropdown.style.width = rect.width + 'px';
        }
    };
    
    window.addEventListener('scroll', updatePosition, true);
    window.addEventListener('resize', updatePosition);
    
    options.forEach(option => {
        option.addEventListener('click', function() {
            const value = this.getAttribute('data-value');
            const text = this.textContent;
            
            hiddenInput.value = value;
            textDisplay.textContent = text;
            dropdown.classList.remove('active');
            
            if (dropdown.parentElement !== wrapper) {
                wrapper.appendChild(dropdown);
                dropdown.style.position = '';
                dropdown.style.top = '';
                dropdown.style.left = '';
                dropdown.style.width = '';
                dropdown.style.zIndex = '';
            }
            
            applyFilters();
        });
    });
    
    if (dropdown.parentElement !== wrapper) {
        wrapper.appendChild(dropdown);
        dropdown.style.position = '';
        dropdown.style.top = '';
        dropdown.style.left = '';
        dropdown.style.width = '';
        dropdown.style.zIndex = '';
    }
}

function initMap() {
    map = L.map('earthquakeMap', {
        center: [39.0, 35.0],
        zoom: 6,
        zoomControl: true,
        attributionControl: true
    });
    
    setTimeout(() => {
        updateMapTheme();
    }, 100);
    
    const bounds = [[TURKEY_BOUNDS.minLat, TURKEY_BOUNDS.minLng], [TURKEY_BOUNDS.maxLat, TURKEY_BOUNDS.maxLng]];
    map.fitBounds(bounds);
    
    map.on('zoomend', function() {
        if (earthquakeData.length > 0) {
            pulseRings.forEach(ring => {
                if (map.hasLayer(ring)) {
                    map.removeLayer(ring);
                }
            });
            pulseRings = [];
            animationIds.forEach(id => clearTimeout(id));
            animationIds = [];
            
            let latestEarthquake = null;
            let latestTime = 0;
            earthquakeData.forEach(earthquake => {
                const time = earthquake.properties.time || 0;
                if (time > latestTime) {
                    latestTime = time;
                    latestEarthquake = earthquake;
                }
            });
            
            if (latestEarthquake) {
                const [lng, lat] = latestEarthquake.geometry.coordinates;
                const magnitude = latestEarthquake.properties.mag;
                const depth = latestEarthquake.geometry.coordinates[2];
                
                let color = '#8B0000';
                let glowColor = 'rgba(139, 0, 0, 0.6)';
                
                if (depth > 80 && depth <= 150) {
                    color = '#00CED1';
                    glowColor = 'rgba(0, 206, 209, 0.6)';
                } else if (depth > 40 && depth <= 80) {
                    color = '#90EE90';
                    glowColor = 'rgba(144, 238, 144, 0.6)';
                } else if (depth > 20 && depth <= 40) {
                    color = '#FFD700';
                    glowColor = 'rgba(255, 215, 0, 0.6)';
                } else if (depth > 10 && depth <= 20) {
                    color = '#FF8C00';
                    glowColor = 'rgba(255, 140, 0, 0.6)';
                } else if (depth > 5 && depth <= 10) {
                    color = '#FF0000';
                    glowColor = 'rgba(255, 0, 0, 0.6)';
                } else if (depth >= 0 && depth <= 5) {
                    color = '#8B0000';
                    glowColor = 'rgba(139, 0, 0, 0.6)';
                }
                
                createPulseRing(lat, lng, color, glowColor, magnitude);
            }
        }
    });
}

function updateMapTheme() {
    if (!map) return;
    
    map.eachLayer(function(layer) {
        if (layer instanceof L.TileLayer) {
            map.removeLayer(layer);
        }
    });
    
    const isLight = document.body.classList.contains('light-theme');
    
    if (isLight) {
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            maxZoom: 19
        }).addTo(map);
    } else {
        L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
            subdomains: 'abcd',
            maxZoom: 19
        }).addTo(map);
    }
}

async function loadEarthquakeData() {
    const proxyUrl = '<?php echo SITE_URL; ?>/api/kandilli.php';
    
    try {
        document.getElementById('earthquakeList').innerHTML = '<div class="loading"><i class="fas fa-spinner fa-spin"></i> Veriler yükleniyor...</div>';
        
        const apiUrl = proxyUrl.includes('?') ? proxyUrl + '&debug=1' : proxyUrl + '?debug=1';
        const response = await fetch(apiUrl);
        
        if (!response.ok) {
            throw new Error(`HTTP hatası! Durum: ${response.status}`);
        }
        
        const contentType = response.headers.get('content-type');
        if (!contentType || !contentType.includes('application/json')) {
            const text = await response.text();
            throw new Error('API JSON döndürmüyor. HTML yanıt alındı.');
        }
        
        const result = await response.json();
        
        if (result.error) {
            throw new Error(result.message || 'Bilinmeyen hata');
        }
        
        if (!result.data || !result.data.features || !Array.isArray(result.data.features)) {
            throw new Error('Geçersiz veri formatı - API yanıt formatı beklenenden farklı');
        }
        
        earthquakeData = result.data.features.filter(earthquake => {
            if (!earthquake.geometry || !earthquake.geometry.coordinates) {
                return false;
            }
            return true;
        });
        
        updateStats();
        applyFilters();
    } catch (error) {
        document.getElementById('earthquakeList').innerHTML = 
            '<div class="error">' +
            '<i class="fas fa-exclamation-triangle"></i> ' +
            '<strong>Hata:</strong> ' + error.message + '<br>' +
            '<small>Lütfen sayfayı yenileyin veya daha sonra tekrar deneyin.</small>' +
            '</div>';
        
        document.getElementById('totalEarthquakes').textContent = '0';
        document.getElementById('maxMagnitude').textContent = '0.0';
        document.getElementById('lastUpdate').textContent = '-';
    }
}

function applyFilters() {
    markers.forEach(marker => map.removeLayer(marker));
    markers = [];
    pulseRings.forEach(ring => {
        if (map.hasLayer(ring)) {
            map.removeLayer(ring);
        }
    });
    pulseRings = [];
    animationIds.forEach(id => clearTimeout(id));
    animationIds = [];
    
    const selectedCity = document.getElementById('cityFilter').value;
    const minMagnitude = parseFloat(document.getElementById('magnitudeFilter').value) || 0;
    const timeFilter = document.getElementById('timeFilter').value;
    
    const now = Date.now();
    let timeLimit = 0;
    switch(timeFilter) {
        case 'hour':
            timeLimit = now - (1 * 60 * 60 * 1000);
            break;
        case 'day':
            timeLimit = now - (24 * 60 * 60 * 1000);
            break;
        case 'week':
            timeLimit = now - (7 * 24 * 60 * 60 * 1000);
            break;
        case 'month':
            timeLimit = now - (30 * 24 * 60 * 60 * 1000);
            break;
        default:
            timeLimit = 0;
    }
    
    const filteredData = earthquakeData.filter(earthquake => {
        if (earthquake.properties.mag < minMagnitude) {
            return false;
        }
        
        if (timeLimit > 0 && earthquake.properties.time < timeLimit) {
            return false;
        }
        
        if (selectedCity) {
            const place = earthquake.properties.place || '';
            if (!place) {
                return false;
            }
            
            const placeLower = place.toLowerCase().trim();
            const cityLower = selectedCity.toLowerCase().trim();
            
            if (placeLower.includes(cityLower)) {
                return true;
            }
            
            let placeNormalized = placeLower;
            placeNormalized = placeNormalized
                .replace(/ş/g, 's').replace(/Ş/g, 's')
                .replace(/ı/g, 'i').replace(/İ/g, 'i')
                .replace(/ğ/g, 'g').replace(/Ğ/g, 'g')
                .replace(/ü/g, 'u').replace(/Ü/g, 'u')
                .replace(/ö/g, 'o').replace(/Ö/g, 'o')
                .replace(/ç/g, 'c').replace(/Ç/g, 'c');
            
            const cityNormalized = cityLower
                .replace(/ş/g, 's').replace(/Ş/g, 's')
                .replace(/ı/g, 'i').replace(/İ/g, 'i')
                .replace(/ğ/g, 'g').replace(/Ğ/g, 'g')
                .replace(/ü/g, 'u').replace(/Ü/g, 'u')
                .replace(/ö/g, 'o').replace(/Ö/g, 'o')
                .replace(/ç/g, 'c').replace(/Ç/g, 'c');
            
            if (placeNormalized.includes(cityNormalized)) {
                return true;
            }
            
            placeNormalized = placeNormalized
                .replace(/\s*\([^)]*\)/g, '')
                .split(',')[0]
                .split('-')[0]
                .split('/')[0]
                .trim();
            
            if (placeNormalized.includes(cityNormalized)) {
                return true;
            }
            
            const placeWords = placeNormalized.split(/\s+/);
            const cityWords = cityNormalized.split(/\s+/);
            
            const allWordsMatch = cityWords.every(cityWord => {
                return placeWords.some(placeWord => {
                    return placeWord === cityWord || 
                           placeWord.startsWith(cityWord) || 
                           cityWord.startsWith(placeWord) ||
                           placeWord.includes(cityWord) ||
                           cityWord.includes(placeWord);
                });
            });
            
            if (allWordsMatch) {
                return true;
            }
            
            return false;
        }
        
        return true;
    });
    
    let latestEarthquake = null;
    let latestTime = 0;
    filteredData.forEach(earthquake => {
        const time = earthquake.properties.time || 0;
        if (time > latestTime) {
            latestTime = time;
            latestEarthquake = earthquake;
        }
    });
    
    filteredData.forEach(earthquake => {
        const [lng, lat] = earthquake.geometry.coordinates;
        const magnitude = earthquake.properties.mag;
        const place = earthquake.properties.place || 'Bilinmeyen Konum';
        const time = new Date(earthquake.properties.time);
        
        const depth = earthquake.geometry.coordinates[2];
        let color = '#8B0000';
        let glowColor = 'rgba(139, 0, 0, 0.6)';
        
        if (depth > 80 && depth <= 150) {
            color = '#00CED1';
            glowColor = 'rgba(0, 206, 209, 0.6)';
        } else if (depth > 40 && depth <= 80) {
            color = '#90EE90';
            glowColor = 'rgba(144, 238, 144, 0.6)';
        } else if (depth > 20 && depth <= 40) {
            color = '#FFD700';
            glowColor = 'rgba(255, 215, 0, 0.6)';
        } else if (depth > 10 && depth <= 20) {
            color = '#FF8C00';
            glowColor = 'rgba(255, 140, 0, 0.6)';
        } else if (depth > 5 && depth <= 10) {
            color = '#FF0000';
            glowColor = 'rgba(255, 0, 0, 0.6)';
        } else if (depth >= 0 && depth <= 5) {
            color = '#8B0000';
            glowColor = 'rgba(139, 0, 0, 0.6)';
        }
        
        const currentZoom = map.getZoom();
        const zoomFactor = Math.max(0.6, 1.2 - (currentZoom / 20));
        const markerRadius = Math.max(8, magnitude * 5 * zoomFactor);
        const marker = L.circleMarker([lat, lng], {
            radius: markerRadius,
            fillColor: color,
            color: '#fff',
            weight: Math.max(3, 4 - (currentZoom / 15)),
            opacity: 1,
            fillOpacity: 0.95
        }).addTo(map);
        
        marker.setStyle({
            className: 'earthquake-marker'
        });
        
        const isLatest = latestEarthquake && 
                        earthquake.properties.time === latestEarthquake.properties.time &&
                        earthquake.geometry.coordinates[0] === latestEarthquake.geometry.coordinates[0] &&
                        earthquake.geometry.coordinates[1] === latestEarthquake.geometry.coordinates[1];
        
        if (isLatest) {
            const markerElement = marker.getElement();
            if (markerElement) {
                const path = markerElement.querySelector('path');
                if (path) {
                    path.style.filter = `drop-shadow(0 0 20px ${color}) drop-shadow(0 0 30px ${color}) drop-shadow(0 0 40px ${color})`;
                    path.style.transition = 'all 0.3s ease';
                }
            }
            
            createPulseRing(lat, lng, color, glowColor, magnitude);
        } else {
            const markerElement = marker.getElement();
            if (markerElement) {
                const path = markerElement.querySelector('path');
                if (path) {
                    path.style.filter = 'none';
                }
            }
        }
        
        marker.bindPopup(`
            <div class="popup-content">
                <h3><i class="fas fa-map-marker-alt"></i> ${place}</h3>
                <p><strong>Büyüklük:</strong> ${magnitude.toFixed(1)}</p>
                <p><strong>Tarih:</strong> ${time.toLocaleString('tr-TR')}</p>
                <p><strong>Derinlik:</strong> ${earthquake.geometry.coordinates[2].toFixed(1)} km</p>
            </div>
        `, {
            className: 'custom-popup'
        });
        
        markers.push(marker);
    });
    
    displayEarthquakeList(filteredData);
}

function createPulseRing(lat, lng, color, glowColor, magnitude) {
    if (!map) return;
    
    const baseRadius = Math.max(3000, magnitude * 5000);
    const ringCount = 4;
    const maxRadius = baseRadius * 8;
    
    for (let i = 0; i < ringCount; i++) {
        const delay = i * 0.5;
        animatePulseRing(lat, lng, baseRadius, maxRadius, color, glowColor, delay, magnitude, i);
    }
}

function animatePulseRing(lat, lng, startRadius, maxRadius, color, glowColor, delay, magnitude, ringIndex) {
    if (!map) return;
    
    let currentRadius = startRadius;
    let opacity = 1.0;
    const totalFrames = 180;
    const radiusStep = (maxRadius - startRadius) / totalFrames;
    const fadeSpeed = 1.0 / totalFrames;
    let currentRing = null;
    let isActive = true;
    let animationId = null;
    
    const animate = () => {
        if (!isActive || !map) {
            if (currentRing && map.hasLayer(currentRing)) {
                map.removeLayer(currentRing);
            }
            return;
        }
        
        if (currentRing && map.hasLayer(currentRing)) {
            map.removeLayer(currentRing);
        }
        
        const ringWeight = Math.max(1.5, 1.5 + (magnitude * 0.2));
        
        try {
            currentRing = L.circle([lat, lng], {
                radius: currentRadius,
                color: color,
                fillColor: 'transparent',
                weight: ringWeight,
                opacity: opacity,
                className: 'pulse-ring',
                fillOpacity: 0
            }).addTo(map);
            
            setTimeout(() => {
                if (currentRing && map.hasLayer(currentRing)) {
                    const element = currentRing.getElement();
                    if (element) {
                        const svgPath = element.querySelector('path');
                        if (svgPath) {
                            const glowSize = 60;
                            
                            svgPath.style.filter = `
                                drop-shadow(0 0 ${glowSize}px ${color}) 
                                drop-shadow(0 0 ${glowSize * 1.6}px ${color}) 
                                drop-shadow(0 0 ${glowSize * 2.8}px ${color})
                            `;
                            svgPath.style.transition = 'opacity 0.05s ease-out';
                            svgPath.style.strokeWidth = ringWeight;
                            svgPath.style.stroke = color;
                            svgPath.style.strokeLinecap = 'round';
                            svgPath.style.strokeLinejoin = 'round';
                        }
                    }
                }
            }, 10);
            
            pulseRings.push(currentRing);
        } catch (e) {
        }
        
        currentRadius += radiusStep;
        opacity -= fadeSpeed;
        
        if (currentRadius >= maxRadius || opacity <= 0.05) {
            if (currentRing && map.hasLayer(currentRing)) {
                map.removeLayer(currentRing);
            }
            currentRadius = startRadius;
            opacity = 1.0;
        }
        
        animationId = setTimeout(animate, 30);
        animationIds.push(animationId);
    };
    
    const startId = setTimeout(() => {
        if (isActive && map) {
            animate();
        }
    }, delay * 1000);
    animationIds.push(startId);
}

function displayEarthquakeList(data) {
    const listContainer = document.getElementById('earthquakeList');
    
    if (!data || data.length === 0) {
        listContainer.innerHTML = '<div class="no-data"><i class="fas fa-info-circle"></i> Henüz deprem verisi bulunmuyor. Lütfen daha sonra tekrar deneyin.</div>';
        return;
    }
    
    data.sort((a, b) => {
        const timeA = a.properties.time || 0;
        const timeB = b.properties.time || 0;
        return timeB - timeA;
    });
    
    listContainer.innerHTML = data.map(earthquake => {
        const magnitude = earthquake.properties.mag;
        const place = earthquake.properties.place || 'Bilinmeyen Konum';
        const time = new Date(earthquake.properties.time);
        const depth = earthquake.geometry.coordinates[2];
        
        let magnitudeClass = 'magnitude-low';
        if (magnitude >= 6) magnitudeClass = 'magnitude-high';
        else if (magnitude >= 5) magnitudeClass = 'magnitude-medium-high';
        else if (magnitude >= 4) magnitudeClass = 'magnitude-medium';
        
        return `
            <div class="earthquake-item" data-magnitude="${magnitude}">
                <div class="earthquake-magnitude ${magnitudeClass}">
                    <span>${magnitude.toFixed(1)}</span>
                </div>
                <div class="earthquake-details">
                    <h3>${place}</h3>
                    <div class="earthquake-meta">
                        <span><i class="fas fa-clock"></i> ${time.toLocaleString('tr-TR')}</span>
                        <span><i class="fas fa-arrows-alt-v"></i> ${depth.toFixed(1)} km derinlik</span>
                    </div>
                </div>
            </div>
        `;
    }).join('');
}

function updateStats() {
    if (earthquakeData.length === 0) {
        document.getElementById('totalEarthquakes').textContent = '0';
        document.getElementById('maxMagnitude').textContent = '0.0';
        document.getElementById('lastUpdate').textContent = new Date().toLocaleTimeString('tr-TR');
        return;
    }
    
    document.getElementById('totalEarthquakes').textContent = earthquakeData.length;
    
    const magnitudes = earthquakeData.map(e => e.properties?.mag || 0).filter(m => m > 0);
    if (magnitudes.length > 0) {
        const maxMagnitude = Math.max(...magnitudes);
        document.getElementById('maxMagnitude').textContent = maxMagnitude.toFixed(1);
    } else {
        document.getElementById('maxMagnitude').textContent = '0.0';
    }
    
    const lastUpdate = new Date();
    document.getElementById('lastUpdate').textContent = lastUpdate.toLocaleTimeString('tr-TR');
}

function checkActiveScenario() {
    try {
        const activeScenario = localStorage.getItem('activeScenario');
        if (activeScenario) {
            const scenarioData = JSON.parse(activeScenario);
            if (scenarioData && scenarioData.active) {
                displayScenarioOnMap(scenarioData);
            }
        }
    } catch (error) {
        console.error('Error checking active scenario:', error);
    }
}

function displayScenarioOnMap(scenarioData) {
    if (!map || !scenarioData) return;
    
    removeScenarioFromMap();
    
    const coordinates = scenarioData.coordinates || scenarioData.coords;
    if (!coordinates || !Array.isArray(coordinates) || coordinates.length < 2) return;
    
    const [lng, lat] = coordinates;
    const magnitude = scenarioData.magnitude || scenarioData.mag || 7.0;
    const location = scenarioData.location || scenarioData.name || 'Senaryo Konumu';
    const depth = scenarioData.depth || 10;
    
    const iconSize = Math.min(30 + (magnitude * 3), 60);
    const icon = L.divIcon({
        className: 'scenario-marker',
        html: `<div style="width: ${iconSize}px; height: ${iconSize}px; background: radial-gradient(circle, rgba(239,68,68,0.8) 0%, rgba(220,38,38,0.6) 50%, rgba(220,38,38,0.3) 100%); border-radius: 50%; border: 3px solid #fff; box-shadow: 0 0 20px rgba(239,68,68,0.8);"></div>`,
        iconSize: [iconSize, iconSize],
        iconAnchor: [iconSize/2, iconSize/2]
    });
    
    scenarioMarker = L.marker([lat, lng], { icon: icon }).addTo(map);
    
    scenarioMarker.bindPopup(`
        <div class="popup-content">
            <h3><i class="fas fa-vial"></i> ${location}</h3>
            <p><strong>Büyüklük:</strong> ${magnitude.toFixed(1)}</p>
            <p><strong>Derinlik:</strong> ${depth.toFixed(1)} km</p>
            <p><em>Senaryo Modu Aktif</em></p>
        </div>
    `, {
        className: 'custom-popup'
    }).openPopup();
    
    const color = '#ef4444';
    const glowColor = 'rgba(239, 68, 68, 0.6)';
    createScenarioRings(lat, lng, color, glowColor, magnitude);
}

function removeScenarioFromMap() {
    if (scenarioMarker && map) {
        map.removeLayer(scenarioMarker);
        scenarioMarker = null;
    }
    
    scenarioRings.forEach(ring => {
        if (map && map.hasLayer(ring)) {
            map.removeLayer(ring);
        }
    });
    scenarioRings = [];
    
    scenarioAnimationIds.forEach(id => clearTimeout(id));
    scenarioAnimationIds = [];
}

function createScenarioRings(lat, lng, color, glowColor, magnitude) {
    if (!map) return;
    
    const baseRadius = Math.max(5000, magnitude * 8000);
    const ringCount = 3;
    const maxRadius = baseRadius * 6;
    
    for (let i = 0; i < ringCount; i++) {
        const delay = i * 0.8;
        animateScenarioRing(lat, lng, baseRadius, maxRadius, color, glowColor, delay, magnitude, i);
    }
}

function animateScenarioRing(lat, lng, startRadius, maxRadius, color, glowColor, delay, magnitude, ringIndex) {
    if (!map) return;
    
    let currentRadius = startRadius;
    let opacity = 0.8;
    const totalFrames = 120;
    const radiusStep = (maxRadius - startRadius) / totalFrames;
    const fadeSpeed = 0.8 / totalFrames;
    let currentRing = null;
    let isActive = true;
    let animationId = null;
    
    const animate = () => {
        if (!isActive || !map) {
            if (currentRing && map.hasLayer(currentRing)) {
                map.removeLayer(currentRing);
            }
            return;
        }
        
        if (currentRing && map.hasLayer(currentRing)) {
            map.removeLayer(currentRing);
        }
        
        const ringWeight = Math.max(2, 2 + (magnitude * 0.3));
        
        try {
            currentRing = L.circle([lat, lng], {
                radius: currentRadius,
                color: color,
                fillColor: 'transparent',
                weight: ringWeight,
                opacity: opacity,
                className: 'scenario-ring',
                fillOpacity: 0
            }).addTo(map);
            
            setTimeout(() => {
                if (currentRing && map.hasLayer(currentRing)) {
                    const element = currentRing.getElement();
                    if (element) {
                        const svgPath = element.querySelector('path');
                        if (svgPath) {
                            const glowSize = 80;
                            svgPath.style.filter = `
                                drop-shadow(0 0 ${glowSize}px ${color}) 
                                drop-shadow(0 0 ${glowSize * 1.6}px ${color}) 
                                drop-shadow(0 0 ${glowSize * 2.8}px ${color})
                            `;
                            svgPath.style.transition = 'opacity 0.05s ease-out';
                            svgPath.style.strokeWidth = ringWeight;
                            svgPath.style.stroke = color;
                            svgPath.style.strokeLinecap = 'round';
                            svgPath.style.strokeLinejoin = 'round';
                        }
                    }
                }
            }, 10);
            
            scenarioRings.push(currentRing);
        } catch (e) {
            console.error('Error creating scenario ring:', e);
        }
        
        currentRadius += radiusStep;
        opacity -= fadeSpeed;
        
        if (currentRadius >= maxRadius || opacity <= 0.05) {
            if (currentRing && map.hasLayer(currentRing)) {
                map.removeLayer(currentRing);
            }
            currentRadius = startRadius;
            opacity = 0.8;
        }
        
        animationId = setTimeout(animate, 50);
        scenarioAnimationIds.push(animationId);
    };
    
    const startId = setTimeout(() => {
        if (isActive && map) {
            animate();
        }
    }, delay * 1000);
    scenarioAnimationIds.push(startId);
}
</script>


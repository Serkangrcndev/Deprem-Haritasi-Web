<div class="main-content">
    <div class="container">
        <div class="scenarios-page info-page">
            <div class="page-header">
                <h1><i class="fas fa-vial"></i> Deprem Senaryoları</h1>
                <p class="lead">Geçmişte yaşanan büyük depremlerin senaryolarını test edin ve etkilerini görün</p>
            </div>
            
            <div class="parent">
                <div class="div1">
                    <div class="info-section-card">
                        <div class="section-header">
                            <h2><i class="fas fa-list"></i> Senaryo Seçimi</h2>
                        </div>
                        <div class="section-body">
                            <div class="scenario-list">
                                <div class="scenario-item" data-scenario="chile1960">
                                    <div class="scenario-icon" style="background: linear-gradient(135deg, #ef4444, #dc2626);">
                                        <i class="fas fa-globe-americas"></i>
                                    </div>
                                    <div class="scenario-content">
                                        <h3>Şili Depremi (1960)</h3>
                                        <p>9.5 Mw - Valdivia, Şili</p>
                                    </div>
                                </div>
                                
                                <div class="scenario-item" data-scenario="sumatra2004">
                                    <div class="scenario-icon" style="background: linear-gradient(135deg, #f59e0b, #ef4444);">
                                        <i class="fas fa-water"></i>
                                    </div>
                                    <div class="scenario-content">
                                        <h3>Hint Okyanusu (2004)</h3>
                                        <p>9.1-9.3 Mw - Sumatra, Endonezya</p>
                                    </div>
                                </div>
                                
                                <div class="scenario-item" data-scenario="japan2011">
                                    <div class="scenario-icon" style="background: linear-gradient(135deg, #6366f1, #8b5cf6);">
                                        <i class="fas fa-mountain"></i>
                                    </div>
                                    <div class="scenario-content">
                                        <h3>Tōhoku Depremi (2011)</h3>
                                        <p>9.0-9.1 Mw - Japonya</p>
                                    </div>
                                </div>
                                
                                <div class="scenario-item" data-scenario="izmit1999">
                                    <div class="scenario-icon" style="background: linear-gradient(135deg, #ec4899, #f59e0b);">
                                        <i class="fas fa-flag"></i>
                                    </div>
                                    <div class="scenario-content">
                                        <h3>İzmit Depremi (1999)</h3>
                                        <p>7.6 Mw - Kocaeli, Türkiye</p>
                                    </div>
                                </div>
                                
                                <div class="scenario-item" data-scenario="maras2023">
                                    <div class="scenario-icon" style="background: linear-gradient(135deg, #dc2626, #991b1b);">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </div>
                                    <div class="scenario-content">
                                        <h3>Kahramanmaraş (2023)</h3>
                                        <p>7.8 ve 7.5 Mw - Türkiye</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="div2">
                    <div class="info-section-card">
                        <div class="section-header">
                            <h2><i class="fas fa-info-circle"></i> Senaryo Detayları</h2>
                        </div>
                        <div class="section-body">
                            <div class="scenario-details" id="scenarioDetails">
                                <div class="feature-card">
                                    <div class="feature-icon-wrapper">
                                        <i class="fas fa-hand-pointer"></i>
                                    </div>
                                    <h3>Senaryo Seçin</h3>
                                    <p>Sol taraftan bir deprem senaryosu seçerek detaylarını görüntüleyin ve test edin.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="div3">
                    <div class="info-section-card">
                        <div class="section-header">
                            <h2><i class="fas fa-map"></i> Harita</h2>
                        </div>
                        <div class="section-body">
                            <div class="scenario-map-container">
                                <div id="scenarioMap"></div>
                                <div class="simulation-status-text" id="simulationStatusText">
                                    Senaryo seçildiğinde harita burada görüntülenecektir.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="div4">
                    <div class="info-section-card">
                        <div class="section-header">
                            <h2><i class="fas fa-play-circle"></i> Test Kontrolleri</h2>
                        </div>
                        <div class="section-body">
                            <div class="test-controls">
                                <button class="btn-test" id="btnStartTest" disabled>
                                    <i class="fas fa-play"></i> Senaryoyu Başlat
                                </button>
                                <button class="btn-test" id="btnResetTest" disabled>
                                    <i class="fas fa-redo"></i> Sıfırla
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="div5">
                    <div class="info-section-card">
                        <div class="section-header">
                            <h2><i class="fas fa-chart-bar"></i> Etki Analizi</h2>
                        </div>
                        <div class="section-body">
                            <div class="impact-analysis" id="impactAnalysis">
                                <div class="feature-card">
                                    <div class="feature-icon-wrapper">
                                        <i class="fas fa-chart-line"></i>
                                    </div>
                                    <h3>Analiz Bekleniyor</h3>
                                    <p>Senaryo seçildiğinde etki analizi burada görüntülenecektir.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="div6">
                    <div class="info-section-card">
                        <div class="section-header">
                            <h2><i class="fas fa-clipboard-check"></i> Sonuçlar</h2>
                        </div>
                        <div class="section-body">
                            <div class="test-results" id="testResults">
                                <div class="feature-card">
                                    <div class="feature-icon-wrapper">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                    <h3>Test Tamamlanmadı</h3>
                                    <p>Senaryo test edildiğinde sonuçlar burada görüntülenecektir.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
const scenarios = {
    chile1960: {
        name: "Şili Depremi (1960)",
        magnitude: 9.5,
        location: "Valdivia, Şili",
        coordinates: [-73.245, -39.820],
        date: "22 Mayıs 1960",
        depth: 33,
        description: "Kayıtlara geçen en büyük deprem. Büyük tsunami oluşturdu ve Pasifik Okyanusu'na yayıldı.",
        impacts: {
            casualties: "1,000-6,000",
            damage: "Çok yüksek",
            tsunami: "Evet",
            aftershocks: "Çok sayıda"
        },
        simulation: {
            duration: 10,
            intensity: "Çok yüksek",
            shaking: "Şiddetli sallanma, binalar yıkıldı"
        }
    },
    sumatra2004: {
        name: "Hint Okyanusu Depremi (2004)",
        magnitude: 9.1,
        location: "Sumatra, Endonezya",
        coordinates: [95.854, 3.316],
        date: "26 Aralık 2004",
        depth: 30,
        description: "Tsunami oluşturan büyük deprem. 14 ülkede etkili oldu.",
        impacts: {
            casualties: "230,000+",
            damage: "Aşırı yüksek",
            tsunami: "Evet (büyük)",
            aftershocks: "Çok sayıda"
        },
        simulation: {
            duration: 8,
            intensity: "Çok yüksek",
            shaking: "Şiddetli sallanma, tsunami uyarısı"
        }
    },
    japan2011: {
        name: "Tōhoku Depremi (2011)",
        magnitude: 9.0,
        location: "Japonya",
        coordinates: [142.373, 38.297],
        date: "11 Mart 2011",
        depth: 29,
        description: "Fukushima nükleer kazasına neden oldu. Büyük tsunami oluşturdu.",
        impacts: {
            casualties: "15,000+",
            damage: "Aşırı yüksek",
            tsunami: "Evet (büyük)",
            aftershocks: "Çok sayıda"
        },
        simulation: {
            duration: 6,
            intensity: "Çok yüksek",
            shaking: "Şiddetli sallanma, nükleer risk"
        }
    },
    izmit1999: {
        name: "İzmit Depremi (1999)",
        magnitude: 7.6,
        location: "Kocaeli, Türkiye",
        coordinates: [29.976, 40.767],
        date: "17 Ağustos 1999",
        depth: 17,
        description: "Türkiye'nin en yıkıcı depremlerinden biri. Kuzey Anadolu Fay Hattı üzerinde meydana geldi.",
        impacts: {
            casualties: "17,000+",
            damage: "Yüksek",
            tsunami: "Hayır",
            aftershocks: "Orta"
        },
        simulation: {
            duration: 45,
            intensity: "Yüksek",
            shaking: "Güçlü sallanma, binalar hasar gördü"
        }
    },
    maras2023: {
        name: "Kahramanmaraş Depremleri (2023)",
        magnitude: 7.8,
        location: "Türkiye",
        coordinates: [37.174, 37.577],
        date: "6 Şubat 2023",
        depth: 10,
        description: "Çift deprem. İlk deprem 7.8, ikinci deprem 7.5 büyüklüğündeydi. Büyük yıkım.",
        impacts: {
            casualties: "50,000+",
            damage: "Aşırı yüksek",
            tsunami: "Hayır",
            aftershocks: "Çok sayıda"
        },
        simulation: {
            duration: 90,
            intensity: "Çok yüksek",
            shaking: "Çok şiddetli sallanma, çift deprem etkisi"
        }
    }
};

let currentScenario = null;
let isTestRunning = false;
let scenarioMap = null;
let scenarioMarker = null;
let scenarioRings = [];
let ringAnimation = null;

document.querySelectorAll('.scenario-item').forEach(item => {
    item.addEventListener('click', function() {
        const scenarioKey = this.getAttribute('data-scenario');
        selectScenario(scenarioKey);
    });
});

function selectScenario(key) {
    currentScenario = key;
    const scenario = scenarios[key];
    
    document.querySelectorAll('.scenario-item').forEach(item => {
        item.classList.remove('active');
    });
    document.querySelector(`[data-scenario="${key}"]`).classList.add('active');
    
    document.getElementById('scenarioDetails').innerHTML = `
        <div class="scenario-detail-content">
            <h3>${scenario.name}</h3>
            <div class="detail-item">
                <strong>Büyüklük:</strong> ${scenario.magnitude} Mw
            </div>
            <div class="detail-item">
                <strong>Konum:</strong> ${scenario.location}
            </div>
            <div class="detail-item">
                <strong>Tarih:</strong> ${scenario.date}
            </div>
            <div class="detail-item">
                <strong>Derinlik:</strong> ${scenario.depth} km
            </div>
            <p>${scenario.description}</p>
        </div>
    `;
    
    displayScenarioOnMap(scenario);
    
    document.getElementById('impactAnalysis').innerHTML = `
        <div class="impact-content">
            <div class="impact-item">
                <strong>Can Kaybı:</strong> ${scenario.impacts.casualties}
            </div>
            <div class="impact-item">
                <strong>Hasar:</strong> ${scenario.impacts.damage}
            </div>
            <div class="impact-item">
                <strong>Tsunami:</strong> ${scenario.impacts.tsunami}
            </div>
            <div class="impact-item">
                <strong>Artçı Depremler:</strong> ${scenario.impacts.aftershocks}
            </div>
        </div>
    `;
    
    document.getElementById('btnStartTest').disabled = false;
    document.getElementById('btnResetTest').disabled = false;
}

function initScenarioMap() {
    if (scenarioMap) {
        scenarioMap.remove();
    }
    
    scenarioMap = L.map('scenarioMap', {
        center: [20, 0],
        zoom: 2,
        zoomControl: true,
        attributionControl: false
    });
    
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap'
    }).addTo(scenarioMap);
}

function displayScenarioOnMap(scenario) {
    if (!scenarioMap) {
        initScenarioMap();
    }
    
    const [lng, lat] = scenario.coordinates;
    
    scenarioMap.setView([lat, lng], scenario.magnitude > 8 ? 5 : 7);
    
    if (scenarioMarker) {
        scenarioMap.removeLayer(scenarioMarker);
    }
    
    const iconSize = Math.min(30 + (scenario.magnitude * 3), 60);
    const icon = L.divIcon({
        className: 'scenario-marker',
        html: `<div style="width: ${iconSize}px; height: ${iconSize}px; background: radial-gradient(circle, rgba(239,68,68,0.8) 0%, rgba(220,38,38,0.6) 50%, rgba(220,38,38,0.3) 100%); border-radius: 50%; border: 3px solid #fff; box-shadow: 0 0 10px rgba(239,68,68,0.8);"></div>`,
        iconSize: [iconSize, iconSize],
        iconAnchor: [iconSize/2, iconSize/2]
    });
    
    scenarioMarker = L.marker([lat, lng], { icon: icon }).addTo(scenarioMap);
    
    scenarioMarker.bindPopup(`
        <strong>${scenario.name}</strong><br>
        Büyüklük: ${scenario.magnitude} Mw<br>
        Derinlik: ${scenario.depth} km<br>
        Konum: ${scenario.location}
    `).openPopup();
    
    clearScenarioRings();
    createRippleEffect(lat, lng, scenario.magnitude);
}

function createRippleEffect(lat, lng, magnitude) {
    const maxRadius = magnitude * 50000;
    const ringCount = 3;
    const ringInterval = maxRadius / ringCount;
    
    let currentRadius = 0;
    const ringSpeed = maxRadius / (scenarios[currentScenario].simulation.duration * 10);
    
    ringAnimation = setInterval(() => {
        if (currentRadius >= maxRadius) {
            currentRadius = 0;
            clearScenarioRings();
        }
        
        const ring = L.circle([lat, lng], {
            radius: currentRadius,
            color: '#ef4444',
            fillColor: '#ef4444',
            fillOpacity: 0.1 - (currentRadius / maxRadius) * 0.1,
            weight: 2,
            opacity: 0.6 - (currentRadius / maxRadius) * 0.6
        }).addTo(scenarioMap);
        
        scenarioRings.push(ring);
        
        if (scenarioRings.length > ringCount * 2) {
            const oldRing = scenarioRings.shift();
            scenarioMap.removeLayer(oldRing);
        }
        
        currentRadius += ringSpeed;
    }, 100);
}

function clearScenarioRings() {
    if (ringAnimation) {
        clearInterval(ringAnimation);
        ringAnimation = null;
    }
    
    scenarioRings.forEach(ring => {
        if (scenarioMap && scenarioMap.hasLayer(ring)) {
            scenarioMap.removeLayer(ring);
        }
    });
    scenarioRings = [];
}

document.getElementById('btnStartTest').addEventListener('click', function() {
    if (!currentScenario || isTestRunning) return;
    
    isTestRunning = true;
    const scenario = scenarios[currentScenario];
    
    const statusText = document.getElementById('simulationStatusText');
    if (statusText) {
        statusText.innerHTML = `<div class="simulation-timer">${scenario.simulation.duration} saniye</div>`;
    }
    
    clearScenarioRings();
    createRippleEffect(scenario.coordinates[1], scenario.coordinates[0], scenario.magnitude);
    
    let timeLeft = scenario.simulation.duration;
    const countdown = setInterval(() => {
        timeLeft--;
        const timerEl = document.getElementById('simulationStatusText');
        if (timerEl) {
            const timerDiv = timerEl.querySelector('.simulation-timer');
            if (timerDiv) {
                timerDiv.textContent = `${timeLeft} saniye`;
            } else {
                timerEl.innerHTML = `<div class="simulation-timer">${timeLeft} saniye</div>`;
            }
        }
        
        if (timeLeft <= 0) {
            clearInterval(countdown);
            clearScenarioRings();
            completeTest();
        }
    }, 1000);
});

function completeTest() {
    isTestRunning = false;
    const scenario = scenarios[currentScenario];
    
    const statusText = document.getElementById('simulationStatusText');
    if (statusText) {
        statusText.innerHTML = `<div class="simulation-timer success">Tamamlandı!</div>`;
    }
    
    document.getElementById('testResults').innerHTML = `
        <div class="results-content">
            <h3>Sonuçlar</h3>
            <div class="result-item">
                <strong>Senaryo:</strong> ${scenario.name}
            </div>
            <div class="result-item">
                <strong>Süre:</strong> ${scenario.simulation.duration}s
            </div>
            <div class="result-item">
                <strong>Şiddet:</strong> ${scenario.simulation.intensity}
            </div>
            <div class="result-item">
                <strong>Can Kaybı:</strong> ${scenario.impacts.casualties}
            </div>
            <div class="result-item">
                <strong>Hasar:</strong> ${scenario.impacts.damage}
            </div>
        </div>
    `;
}

document.getElementById('btnResetTest').addEventListener('click', function() {
    isTestRunning = false;
    currentScenario = null;
    
    document.querySelectorAll('.scenario-item').forEach(item => {
        item.classList.remove('active');
    });
    
    document.getElementById('scenarioDetails').innerHTML = `
        <div class="feature-card">
            <div class="feature-icon-wrapper">
                <i class="fas fa-hand-pointer"></i>
            </div>
            <h3>Senaryo Seçin</h3>
            <p>Sol taraftan bir deprem senaryosu seçerek detaylarını görüntüleyin ve test edin.</p>
        </div>
    `;
    
    document.getElementById('impactAnalysis').innerHTML = `
        <div class="feature-card">
            <div class="feature-icon-wrapper">
                <i class="fas fa-chart-line"></i>
            </div>
            <h3>Analiz Bekleniyor</h3>
            <p>Senaryo seçildiğinde etki analizi burada görüntülenecektir.</p>
        </div>
    `;
    
    clearScenarioRings();
    if (scenarioMarker && scenarioMap) {
        scenarioMap.removeLayer(scenarioMarker);
        scenarioMarker = null;
    }
    
    const statusText = document.getElementById('simulationStatusText');
    if (statusText) {
        statusText.innerHTML = 'Senaryo seçildiğinde harita burada görüntülenecektir.';
    }
    
    if (scenarioMap) {
        scenarioMap.setView([20, 0], 2);
    }
    
    document.getElementById('testResults').innerHTML = `
        <div class="feature-card">
            <div class="feature-icon-wrapper">
                <i class="fas fa-check-circle"></i>
            </div>
            <h3>Test Tamamlanmadı</h3>
            <p>Senaryo test edildiğinde sonuçlar burada görüntülenecektir.</p>
        </div>
    `;
    
    document.getElementById('btnStartTest').disabled = true;
    document.getElementById('btnResetTest').disabled = true;
});
</script>

<style>
.scenario-list {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
    margin-top: 0.5rem;
}

.scenario-item {
    display: flex;
    gap: 0.75rem;
    align-items: center;
    padding: 0.75rem;
    border-radius: 8px;
    border: 1px solid var(--border-color);
    cursor: pointer;
    transition: all 0.3s ease;
}

.scenario-item:hover {
    background: var(--bg-secondary);
    transform: translateX(5px);
}

.scenario-item.active {
    background: var(--bg-secondary);
    border-color: var(--primary);
    box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.2);
}

.scenario-icon {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    color: white;
    flex-shrink: 0;
}

.scenario-content h3 {
    color: var(--text-primary);
    margin-bottom: 0.25rem;
    font-size: 0.875rem;
    font-weight: 600;
}

.scenario-content p {
    color: var(--text-secondary);
    font-size: 0.75rem;
    margin: 0;
}

.scenario-detail-content h3 {
    color: var(--text-primary);
    margin-bottom: 0.75rem;
    font-size: 1rem;
    font-weight: 600;
}

.detail-item {
    color: var(--text-secondary);
    font-size: 0.8125rem;
    margin-bottom: 0.5rem;
    padding-bottom: 0.5rem;
    border-bottom: 1px solid var(--border-color);
}

.detail-item:last-child {
    border-bottom: none;
}

.detail-item strong {
    color: var(--text-primary);
}

.impact-content {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.impact-item {
    color: var(--text-secondary);
    font-size: 0.8125rem;
    padding: 0.5rem 0;
    border-bottom: 1px solid var(--border-color);
}

.impact-item:last-child {
    border-bottom: none;
}

.impact-item strong {
    color: var(--text-primary);
}

.test-controls {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.btn-test {
    width: 100%;
    padding: 0.75rem;
    border: none;
    border-radius: 8px;
    background: var(--primary);
    color: white;
    font-size: 0.875rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.btn-test:hover:not(:disabled) {
    background: var(--primary-hover);
    transform: translateY(-2px);
}

.btn-test:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

.simulation-content {
    text-align: center;
}

.simulation-timer {
    font-size: 1.5rem;
    font-weight: 800;
    color: var(--primary);
    margin-bottom: 0.5rem;
}

.simulation-status {
    color: var(--text-secondary);
    font-size: 0.875rem;
    margin-bottom: 0.75rem;
}

.simulation-status.success {
    color: var(--success);
    font-weight: 600;
}

.simulation-info {
    text-align: left;
    margin-top: 0.75rem;
}

.simulation-info p {
    color: var(--text-secondary);
    font-size: 0.75rem;
    margin: 0.25rem 0;
}

.results-content h3 {
    color: var(--text-primary);
    margin-bottom: 0.5rem;
    font-size: 0.875rem;
    font-weight: 600;
    padding-bottom: 0.375rem;
    border-bottom: 1px solid var(--border-color);
}

.result-item {
    color: var(--text-secondary);
    font-size: 0.75rem;
    margin-bottom: 0.375rem;
    padding-bottom: 0.375rem;
    border-bottom: 1px solid var(--border-color);
    line-height: 1.4;
}

.result-item:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}

.result-item strong {
    color: var(--text-primary);
    font-size: 0.75rem;
}

.scenario-map-container {
    width: 100%;
    height: 100%;
    position: relative;
    border-radius: 8px;
    overflow: hidden;
    background: var(--bg-secondary);
    min-height: 400px;
}

#scenarioMap {
    width: 100%;
    height: 100%;
    min-height: 400px;
    border-radius: 8px;
}

.simulation-status-text {
    position: absolute;
    bottom: 10px;
    left: 50%;
    transform: translateX(-50%);
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 0.5rem 1rem;
    font-size: 0.75rem;
    text-align: center;
    z-index: 1000;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
    border: 1px solid var(--border-color);
}

.simulation-timer {
    font-size: 1rem;
    font-weight: 800;
    color: var(--primary);
    margin: 0;
}

.simulation-timer.success {
    color: var(--success);
}

.scenario-marker {
    background: transparent !important;
    border: none !important;
}
</style>


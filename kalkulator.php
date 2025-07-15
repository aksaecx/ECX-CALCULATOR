<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quantum Calculator Pro</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Orbitron', monospace;
            background: linear-gradient(45deg, #0a0a0a, #1a1a2e, #16213e, #0f3460);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .stars {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        }

        .star {
            position: absolute;
            width: 2px;
            height: 2px;
            background: white;
            border-radius: 50%;
            animation: twinkle 3s infinite;
        }

        @keyframes twinkle {
            0%, 100% { opacity: 0.3; }
            50% { opacity: 1; }
        }

        .calculator-container {
            position: relative;
            z-index: 10;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 30px;
            padding: 30px;
            box-shadow: 
                0 25px 50px rgba(0, 0, 0, 0.4),
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
            width: 420px;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        .title {
            text-align: center;
            color: #00ffff;
            font-size: 1.8em;
            font-weight: 900;
            margin-bottom: 20px;
            text-shadow: 0 0 20px #00ffff;
            animation: glow 2s ease-in-out infinite alternate;
        }

        @keyframes glow {
            from { text-shadow: 0 0 20px #00ffff; }
            to { text-shadow: 0 0 30px #00ffff, 0 0 40px #00ffff; }
        }

        .display-container {
            background: rgba(0, 0, 0, 0.6);
            border: 2px solid #00ffff;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            position: relative;
            overflow: hidden;
        }

        .display-container::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            /* JIKA INGIN MENAMBAHKAN GAMBAR */
            background: url('URL_GAMBAR_ANDA_DISINI') center/cover;
            /* ATAU gunakan multiple background images */
            /* background: url('gambar1.jpg'), url('gambar2.png'), linear-gradient(45deg, #00ffff, #ff00ff); */
            border-radius: 15px;
            z-index: -1;
            animation: borderRotate 3s linear infinite;
        }

        @keyframes borderRotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .display {
            background: rgba(0, 20, 40, 0.9);
            color: #00ffff;
            font-size: 2.5em;
            font-weight: 700;
            text-align: right;
            padding: 15px;
            border-radius: 10px;
            min-height: 60px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            text-shadow: 0 0 10px #00ffff;
            overflow: hidden;
            position: relative;
        }

        .display::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 2px;
            height: 100%;
            background: #00ffff;
            animation: blink 1s infinite;
        }

        @keyframes blink {
            0%, 50% { opacity: 1; }
            51%, 100% { opacity: 0; }
        }

        .mode-selector {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
            gap: 10px;
        }

        .mode-btn {
            padding: 8px 16px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            color: #fff;
            font-size: 0.9em;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .mode-btn.active {
            background: linear-gradient(45deg, #00ffff, #0099cc);
            box-shadow: 0 0 20px rgba(0, 255, 255, 0.5);
            transform: scale(1.05);
        }

        .buttons {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 15px;
            margin-bottom: 20px;
        }

        button {
            padding: 20px 10px;
            font-size: 1.2em;
            font-weight: 700;
            font-family: 'Orbitron', monospace;
            border: none;
            border-radius: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(10px);
        }

        button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        button:hover::before {
            left: 100%;
        }

        .btn-number {
            background: linear-gradient(145deg, #2a2a3a, #1a1a2a);
            color: #fff;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .btn-number:hover {
            background: linear-gradient(145deg, #3a3a4a, #2a2a3a);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
        }

        .btn-operator {
            background: linear-gradient(145deg, #ff6b35, #f7931e);
            color: #fff;
            box-shadow: 0 5px 15px rgba(255, 107, 53, 0.3);
        }

        .btn-operator:hover {
            background: linear-gradient(145deg, #ff8c42, #ff6b35);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 107, 53, 0.5);
        }

        .btn-function {
            background: linear-gradient(145deg, #9c27b0, #673ab7);
            color: #fff;
            box-shadow: 0 5px 15px rgba(156, 39, 176, 0.3);
        }

        .btn-function:hover {
            background: linear-gradient(145deg, #ab47bc, #9c27b0);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(156, 39, 176, 0.5);
        }

        .btn-equals {
            background: linear-gradient(145deg, #00e676, #00c853);
            color: #fff;
            box-shadow: 0 5px 15px rgba(0, 230, 118, 0.3);
            grid-column: span 2;
        }

        .btn-equals:hover {
            background: linear-gradient(145deg, #1de9b6, #00e676);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 230, 118, 0.5);
        }

        .btn-clear {
            background: linear-gradient(145deg, #f44336, #d32f2f);
            color: #fff;
            box-shadow: 0 5px 15px rgba(244, 67, 54, 0.3);
        }

        .btn-clear:hover {
            background: linear-gradient(145deg, #ef5350, #f44336);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(244, 67, 54, 0.5);
        }

        .history {
            background: rgba(0, 0, 0, 0.4);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 15px;
            max-height: 200px;
            overflow-y: auto;
            color: #00ffff;
        }

        .history h3 {
            color: #ff00ff;
            margin-bottom: 10px;
            text-align: center;
            font-size: 1.2em;
        }

        .history-item {
            padding: 8px;
            margin: 5px 0;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 8px;
            font-size: 0.9em;
            animation: slideIn 0.5s ease-out;
        }

        @keyframes slideIn {
            from { transform: translateX(-20px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        .converter-section {
            display: none;
            margin-top: 20px;
            padding: 15px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .converter-section.active {
            display: block;
        }

        .converter-controls {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
            flex-wrap: wrap;
        }

        .converter-input {
            flex: 1;
            padding: 10px;
            background: rgba(0, 0, 0, 0.5);
            border: 1px solid #00ffff;
            border-radius: 8px;
            color: #00ffff;
            font-family: 'Orbitron', monospace;
            min-width: 120px;
        }

        .converter-select {
            padding: 10px;
            background: rgba(0, 0, 0, 0.5);
            border: 1px solid #00ffff;
            border-radius: 8px;
            color: #00ffff;
            font-family: 'Orbitron', monospace;
        }

        .advanced-functions {
            display: none;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            margin-bottom: 20px;
        }

        .advanced-functions.active {
            display: grid;
        }

        .error-message {
            background: rgba(255, 0, 0, 0.2);
            color: #ff6b6b;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 10px;
            text-align: center;
            animation: shake 0.5s ease-in-out;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        /* Scrollbar styling */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(45deg, #00ffff, #ff00ff);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(45deg, #ff00ff, #00ffff);
        }

        /* Responsive design */
        @media (max-width: 480px) {
            .calculator-container {
                width: 95%;
                padding: 20px;
            }
            
            .buttons {
                grid-template-columns: repeat(4, 1fr);
                gap: 10px;
            }
            
            .display {
                font-size: 2em;
            }
            
            button {
                padding: 15px 8px;
                font-size: 1em;
            }
        }
    </style>
</head>
<body>
    <div class="stars"></div>
    
    <div class="calculator-container">
        <div class="title">ECX CALCULATOR</div>
        
        <div class="display-container">
            <div class="display" id="display">0</div>
        </div>
        
        <div class="mode-selector">
            <button class="mode-btn active" onclick="switchMode('basic')">Basic</button>
            <button class="mode-btn" onclick="switchMode('advanced')">Advanced</button>
            <button class="mode-btn" onclick="switchMode('converter')">Converter</button>
        </div>
        
        <div class="advanced-functions" id="advancedFunctions">
            <button class="btn-function" onclick="addToDisplay('sin(')">sin</button>
            <button class="btn-function" onclick="addToDisplay('cos(')">cos</button>
            <button class="btn-function" onclick="addToDisplay('tan(')">tan</button>
            <button class="btn-function" onclick="addToDisplay('log(')">log</button>
            <button class="btn-function" onclick="addToDisplay('ln(')">ln</button>
            <button class="btn-function" onclick="addToDisplay('abs(')">abs</button>
            <button class="btn-function" onclick="addToDisplay('Math.PI')">π</button>
            <button class="btn-function" onclick="addToDisplay('Math.E')">e</button>
            <button class="btn-function" onclick="factorial()">n!</button>
        </div>
        
        <div class="buttons">
            <button class="btn-clear" onclick="clearAll()">AC</button>
            <button class="btn-clear" onclick="clearEntry()">CE</button>
            <button class="btn-operator" onclick="addToDisplay('/')" title="Divide">÷</button>
            <button class="btn-operator" onclick="addToDisplay('*')" title="Multiply">×</button>
            <button class="btn-operator" onclick="deleteLast()">⌫</button>
            
            <button class="btn-number" onclick="addToDisplay('7')">7</button>
            <button class="btn-number" onclick="addToDisplay('8')">8</button>
            <button class="btn-number" onclick="addToDisplay('9')">9</button>
            <button class="btn-operator" onclick="addToDisplay('-')">-</button>
            <button class="btn-function" onclick="addToDisplay('sqrt(')">√</button>
            
            <button class="btn-number" onclick="addToDisplay('4')">4</button>
            <button class="btn-number" onclick="addToDisplay('5')">5</button>
            <button class="btn-number" onclick="addToDisplay('6')">6</button>
            <button class="btn-operator" onclick="addToDisplay('+')">+</button>
            <button class="btn-function" onclick="addToDisplay('**')">x²</button>
            
            <button class="btn-number" onclick="addToDisplay('1')">1</button>
            <button class="btn-number" onclick="addToDisplay('2')">2</button>
            <button class="btn-number" onclick="addToDisplay('3')">3</button>
            <button class="btn-function" onclick="addToDisplay('(')">)</button>
            <button class="btn-function" onclick="addToDisplay(')')">)</button>
            
            <button class="btn-number" onclick="addToDisplay('0')">0</button>
            <button class="btn-number" onclick="addToDisplay('.')">.</button>
            <button class="btn-function" onclick="addToDisplay('%')">%</button>
            <button class="btn-equals" onclick="calculate()">=</button>
        </div>
        
        <div class="converter-section" id="converterSection">
            <div class="converter-controls">
                <input type="number" class="converter-input" id="converterInput" placeholder="Enter value">
                <select class="converter-select" id="converterType">
                    <option value="length">Length</option>
                    <option value="weight">Weight</option>
                    <option value="temperature">Temperature</option>
                    <option value="currency">Currency</option>
                </select>
                <button class="btn-function" onclick="convert()">Convert</button>
            </div>
            <div id="converterResult" style="color: #00ffff; text-align: center; margin-top: 10px;"></div>
        </div>
        
        <div class="history" id="history">
            <h3>⚡ HISTORY ⚡</h3>
            <div id="historyItems"></div>
        </div>
    </div>

    <script>
        let currentDisplay = '0';
        let shouldResetDisplay = false;
        let history = [];
        let currentMode = 'basic';

        // Create stars
        function createStars() {
            const starsContainer = document.querySelector('.stars');
            for (let i = 0; i < 200; i++) {
                const star = document.createElement('div');
                star.className = 'star';
                star.style.left = Math.random() * 100 + '%';
                star.style.top = Math.random() * 100 + '%';
                star.style.animationDelay = Math.random() * 3 + 's';
                starsContainer.appendChild(star);
            }
        }

        function updateDisplay() {
            document.getElementById('display').textContent = currentDisplay;
        }

        function addToDisplay(value) {
            if (shouldResetDisplay) {
                currentDisplay = '0';
                shouldResetDisplay = false;
            }
            
            if (currentDisplay === '0' && value !== '.') {
                currentDisplay = value;
            } else {
                currentDisplay += value;
            }
            updateDisplay();
        }

        function clearAll() {
            currentDisplay = '0';
            updateDisplay();
        }

        function clearEntry() {
            currentDisplay = '0';
            updateDisplay();
        }

        function deleteLast() {
            if (currentDisplay.length > 1) {
                currentDisplay = currentDisplay.slice(0, -1);
            } else {
                currentDisplay = '0';
            }
            updateDisplay();
        }

        function calculate() {
            try {
                let expression = currentDisplay;
                
                // Replace display symbols with JavaScript operators
                expression = expression.replace(/×/g, '*');
                expression = expression.replace(/÷/g, '/');
                expression = expression.replace(/π/g, 'Math.PI');
                expression = expression.replace(/e/g, 'Math.E');
                
                // Handle mathematical functions
                expression = expression.replace(/sin\(/g, 'Math.sin(');
                expression = expression.replace(/cos\(/g, 'Math.cos(');
                expression = expression.replace(/tan\(/g, 'Math.tan(');
                expression = expression.replace(/log\(/g, 'Math.log10(');
                expression = expression.replace(/ln\(/g, 'Math.log(');
                expression = expression.replace(/sqrt\(/g, 'Math.sqrt(');
                expression = expression.replace(/abs\(/g, 'Math.abs(');
                
                // Handle percentage
                expression = expression.replace(/(\d+)%/g, '($1/100)');
                
                const result = eval(expression);
                
                if (isNaN(result) || !isFinite(result)) {
                    throw new Error('Invalid calculation');
                }
                
                const historyItem = `${currentDisplay} = ${result}`;
                history.unshift(historyItem);
                if (history.length > 10) history.pop();
                
                updateHistory();
                currentDisplay = result.toString();
                shouldResetDisplay = true;
                updateDisplay();
                
            } catch (error) {
                showError('Error in calculation');
                currentDisplay = '0';
                updateDisplay();
            }
        }

        function factorial() {
            try {
                const num = parseInt(currentDisplay);
                if (num < 0 || num > 20) {
                    throw new Error('Invalid number for factorial');
                }
                
                let result = 1;
                for (let i = 2; i <= num; i++) {
                    result *= i;
                }
                
                const historyItem = `${num}! = ${result}`;
                history.unshift(historyItem);
                updateHistory();
                
                currentDisplay = result.toString();
                shouldResetDisplay = true;
                updateDisplay();
                
            } catch (error) {
                showError('Error in factorial calculation');
            }
        }

        function switchMode(mode) {
            currentMode = mode;
            
            // Update mode buttons
            document.querySelectorAll('.mode-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            event.target.classList.add('active');
            
            // Show/hide sections
            document.getElementById('advancedFunctions').classList.toggle('active', mode === 'advanced');
            document.getElementById('converterSection').classList.toggle('active', mode === 'converter');
        }

        function convert() {
            const value = parseFloat(document.getElementById('converterInput').value);
            const type = document.getElementById('converterType').value;
            const resultDiv = document.getElementById('converterResult');
            
            if (isNaN(value)) {
                resultDiv.textContent = 'Please enter a valid number';
                return;
            }
            
            let result = '';
            
            switch (type) {
                case 'length':
                    result = `${value} m = ${value * 3.28084} ft = ${value * 39.3701} in = ${value / 1000} km`;
                    break;
                case 'weight':
                    result = `${value} kg = ${value * 2.20462} lbs = ${value * 1000} g = ${value / 1000} tons`;
                    break;
                case 'temperature':
                    const celsius = value;
                    const fahrenheit = (celsius * 9/5) + 32;
                    const kelvin = celsius + 273.15;
                    result = `${celsius}°C = ${fahrenheit.toFixed(2)}°F = ${kelvin.toFixed(2)}K`;
                    break;
                case 'currency':
                    result = `${value} USD ≈ ${(value * 15000).toLocaleString()} IDR (example rate)`;
                    break;
            }
            
            resultDiv.textContent = result;
        }

        function updateHistory() {
            const historyItems = document.getElementById('historyItems');
            historyItems.innerHTML = '';
            
            history.forEach(item => {
                const div = document.createElement('div');
                div.className = 'history-item';
                div.textContent = item;
                historyItems.appendChild(div);
            });
        }

        function showError(message) {
            const errorDiv = document.createElement('div');
            errorDiv.className = 'error-message';
            errorDiv.textContent = message;
            
            const calculator = document.querySelector('.calculator-container');
            calculator.insertBefore(errorDiv, calculator.firstChild);
            
            setTimeout(() => {
                errorDiv.remove();
            }, 3000);
        }

        // Keyboard support
        document.addEventListener('keydown', function(event) {
            const key = event.key;
            
            if (key >= '0' && key <= '9') {
                addToDisplay(key);
            } else if (key === '.') {
                addToDisplay('.');
            } else if (key === '+') {
                addToDisplay('+');
            } else if (key === '-') {
                addToDisplay('-');
            } else if (key === '*') {
                addToDisplay('*');
            } else if (key === '/') {
                event.preventDefault();
                addToDisplay('/');
            } else if (key === 'Enter' || key === '=') {
                calculate();
            } else if (key === 'Escape') {
                clearAll();
            } else if (key === 'Backspace') {
                deleteLast();
            }
        });

        // Initialize
        createStars();
        updateDisplay();
    </script>
</body>
</html>
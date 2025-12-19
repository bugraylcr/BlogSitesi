<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BAUM // Night City</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700;900&family=Rajdhani:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --neon-pink: #ff2a6d;
            --neon-cyan: #05d9e8;
            --neon-purple: #d300c5;
            --neon-yellow: #f9f002;
            --neon-green: #39ff14;
            --neon-orange: #ff6b35;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Rajdhani', sans-serif;
            background: #000;
            color: #fff;
            overflow-x: hidden;
        }

        .scroll-container {
            height: 600vh;
        }

        /* 3D Viewport */
        .viewport {
            position: fixed;
            inset: 0;
            perspective: 800px;
            perspective-origin: 50% 55%;
            overflow: hidden;
            background: linear-gradient(to bottom, #020008 0%, #05001a 50%, #080020 100%);
        }

        /* 3D Scene container */
        .scene {
            position: absolute;
            width: 100%;
            height: 100%;
            transform-style: preserve-3d;
        }

        /* ============ GROUND/STREET ============ */
        .ground-wrapper {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 55%;
            perspective: 300px;
            perspective-origin: 50% 0%;
            overflow: hidden;
        }

        .ground {
            position: absolute;
            top: 0;
            left: -100%;
            width: 300%;
            height: 300%;
            transform: rotateX(75deg);
            transform-origin: center top;
            transform-style: preserve-3d;
        }

        .street-surface {
            position: absolute;
            width: 100%;
            height: 100%;
            background: #08080f;
        }

        /* Asphalt texture */
        .asphalt {
            position: absolute;
            width: 100%;
            height: 100%;
            background:
                repeating-linear-gradient(
                    0deg,
                    transparent 0px,
                    transparent 3px,
                    rgba(255,255,255,0.01) 3px,
                    rgba(255,255,255,0.01) 4px
                );
        }

        /* Yellow center lines */
        .center-lines {
            position: absolute;
            left: 50%;
            top: 0;
            width: 8px;
            height: 100%;
            transform: translateX(-50%);
            background: repeating-linear-gradient(
                0deg,
                rgba(249, 240, 2, 0.9) 0px,
                rgba(249, 240, 2, 0.9) 60px,
                transparent 60px,
                transparent 100px
            );
            box-shadow: 0 0 20px rgba(249, 240, 2, 0.5);
            animation: linesMove 0.8s linear infinite;
        }

        @keyframes linesMove {
            from { transform: translateX(-50%) translateY(0); }
            to { transform: translateX(-50%) translateY(100px); }
        }

        /* Side lane markings */
        .lane-left, .lane-right {
            position: absolute;
            top: 0;
            width: 3px;
            height: 100%;
            background: rgba(255, 255, 255, 0.3);
            animation: linesMove 0.8s linear infinite;
        }
        .lane-left { left: 35%; }
        .lane-right { right: 35%; }

        /* Sidewalks/curbs */
        .curb-left, .curb-right {
            position: absolute;
            top: 0;
            height: 100%;
            background: linear-gradient(90deg, #151520 0%, #1a1a28 50%, #151520 100%);
        }
        .curb-left { left: 0; width: 20%; border-right: 4px solid rgba(5, 217, 232, 0.3); }
        .curb-right { right: 0; width: 20%; border-left: 4px solid rgba(255, 42, 109, 0.3); }

        /* Moving road markers */
        .road-markers {
            position: absolute;
            left: 25%;
            right: 25%;
            top: 0;
            height: 100%;
            animation: linesMove 0.8s linear infinite;
        }

        .road-marker {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 15px;
            background: rgba(5, 217, 232, 0.15);
            border: 1px solid rgba(5, 217, 232, 0.3);
        }

        /* Puddle reflections */
        .puddle {
            position: absolute;
            border-radius: 50%;
            background: radial-gradient(ellipse, rgba(5, 217, 232, 0.25) 0%, rgba(255, 42, 109, 0.15) 40%, transparent 70%);
            animation: pudgleGlow 3s ease-in-out infinite alternate;
        }

        @keyframes pudgleGlow {
            from { opacity: 0.6; }
            to { opacity: 1; }
        }

        /* Manhole covers */
        .manhole {
            position: absolute;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: radial-gradient(circle, #0a0a15 0%, #151520 70%, #0a0a15 100%);
            border: 2px solid rgba(5, 217, 232, 0.2);
            box-shadow: inset 0 0 15px rgba(0,0,0,0.8);
        }

        /* ============ BUILDINGS ============ */
        .building-row {
            position: absolute;
            width: 100%;
            height: 100%;
            transform-style: preserve-3d;
        }

        .building-3d {
            position: absolute;
            transform-style: preserve-3d;
            transition: transform 0.1s linear;
        }

        /* Building faces */
        .building-face {
            position: absolute;
            background: linear-gradient(to top, #0a0318 0%, #0f0428 30%, #08021a 100%);
            backface-visibility: hidden;
        }

        .building-face.front {
            transform: translateZ(var(--depth));
        }

        .building-face.side {
            transform: rotateY(90deg) translateZ(var(--width));
        }

        /* Window pattern */
        .windows {
            position: absolute;
            inset: 20px 10px;
            display: grid;
            grid-template-columns: repeat(auto-fill, 20px);
            grid-template-rows: repeat(auto-fill, 28px);
            gap: 8px;
        }

        .win {
            background: rgba(5, 217, 232, 0.05);
            border: 1px solid rgba(5, 217, 232, 0.1);
        }

        .win.lit {
            background: rgba(5, 217, 232, 0.7);
            box-shadow: 0 0 15px var(--neon-cyan), 0 0 30px var(--neon-cyan);
        }

        .win.lit-pink {
            background: rgba(255, 42, 109, 0.7);
            box-shadow: 0 0 15px var(--neon-pink), 0 0 30px var(--neon-pink);
        }

        .win.lit-yellow {
            background: rgba(249, 240, 2, 0.7);
            box-shadow: 0 0 15px var(--neon-yellow), 0 0 30px var(--neon-yellow);
        }

        /* ============ LEFT BUILDINGS ============ */
        .left-buildings {
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 38%;
            transform-style: preserve-3d;
            will-change: transform;
            backface-visibility: hidden;
        }

        .bldg-left-1 {
            left: 0;
            bottom: 0;
            width: 100%;
            height: 140%;
            background:
                linear-gradient(90deg, #03010a 0%, #080318 60%, #0a0420 85%, #0d0528 100%),
                repeating-linear-gradient(0deg, transparent 0px, transparent 35px, rgba(0,0,0,0.3) 35px, rgba(0,0,0,0.3) 36px);
            border-right: 4px solid rgba(5, 217, 232, 0.4);
            box-shadow:
                inset -30px 0 80px rgba(5, 217, 232, 0.15),
                inset -5px 0 20px rgba(5, 217, 232, 0.2),
                5px 0 30px rgba(0, 0, 0, 0.8);
            z-index: 10;
        }

        .bldg-left-2 {
            left: 25%;
            bottom: 0;
            width: 75%;
            height: 120%;
            background:
                linear-gradient(90deg, #02010a 0%, #060218 50%, #080320 100%),
                repeating-linear-gradient(0deg, transparent 0px, transparent 40px, rgba(0,0,0,0.2) 40px, rgba(0,0,0,0.2) 41px);
            border-right: 2px solid rgba(5, 217, 232, 0.25);
            box-shadow: inset -15px 0 40px rgba(5, 217, 232, 0.08);
            z-index: 8;
        }

        .bldg-left-3 {
            left: 45%;
            bottom: 0;
            width: 55%;
            height: 155%;
            background: linear-gradient(90deg, #01000a 0%, #040115 50%, #050118 100%);
            z-index: 6;
        }

        .bldg-left-4 {
            left: 60%;
            bottom: 0;
            width: 40%;
            height: 180%;
            background: linear-gradient(90deg, #010008 0%, #030112 100%);
            z-index: 4;
        }

        /* ============ RIGHT BUILDINGS ============ */
        .right-buildings {
            position: absolute;
            right: 0;
            top: 0;
            bottom: 0;
            width: 38%;
            transform-style: preserve-3d;
            will-change: transform;
            backface-visibility: hidden;
        }

        .bldg-right-1 {
            right: 0;
            bottom: 0;
            width: 100%;
            height: 135%;
            background:
                linear-gradient(270deg, #03010a 0%, #080318 60%, #0a0420 85%, #0d0528 100%),
                repeating-linear-gradient(0deg, transparent 0px, transparent 35px, rgba(0,0,0,0.3) 35px, rgba(0,0,0,0.3) 36px);
            border-left: 4px solid rgba(255, 42, 109, 0.4);
            box-shadow:
                inset 30px 0 80px rgba(255, 42, 109, 0.15),
                inset 5px 0 20px rgba(255, 42, 109, 0.2),
                -5px 0 30px rgba(0, 0, 0, 0.8);
            z-index: 10;
        }

        .bldg-right-2 {
            right: 25%;
            bottom: 0;
            width: 75%;
            height: 125%;
            background:
                linear-gradient(270deg, #02010a 0%, #060218 50%, #080320 100%),
                repeating-linear-gradient(0deg, transparent 0px, transparent 40px, rgba(0,0,0,0.2) 40px, rgba(0,0,0,0.2) 41px);
            border-left: 2px solid rgba(255, 42, 109, 0.25);
            box-shadow: inset 15px 0 40px rgba(255, 42, 109, 0.08);
            z-index: 8;
        }

        .bldg-right-3 {
            right: 45%;
            bottom: 0;
            width: 55%;
            height: 160%;
            background: linear-gradient(270deg, #01000a 0%, #040115 50%, #050118 100%);
            z-index: 6;
        }

        .bldg-right-4 {
            right: 60%;
            bottom: 0;
            width: 40%;
            height: 175%;
            background: linear-gradient(270deg, #010008 0%, #030112 100%);
            z-index: 4;
        }

        /* Building elements */
        .bldg {
            position: absolute;
        }

        .floor-line {
            position: absolute;
            left: 0;
            right: 0;
            height: 2px;
            background: rgba(5, 217, 232, 0.1);
        }

        .window-row {
            position: absolute;
            display: flex;
            gap: 10px;
            padding: 5px 15px;
        }

        .window-box {
            width: 18px;
            height: 24px;
            background: rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(5, 217, 232, 0.1);
        }

        .window-box.glow {
            background: rgba(5, 217, 232, 0.5);
            box-shadow: 0 0 12px var(--neon-cyan);
            border-color: var(--neon-cyan);
        }

        .window-box.glow-pink {
            background: rgba(255, 42, 109, 0.5);
            box-shadow: 0 0 12px var(--neon-pink);
            border-color: var(--neon-pink);
        }

        .window-box.glow-yellow {
            background: rgba(249, 240, 2, 0.5);
            box-shadow: 0 0 12px var(--neon-yellow);
            border-color: var(--neon-yellow);
        }

        /* AC units and details */
        .ac-unit {
            position: absolute;
            width: 30px;
            height: 20px;
            background: #151520;
            border: 1px solid rgba(5, 217, 232, 0.15);
        }

        .pipe {
            position: absolute;
            width: 8px;
            background: linear-gradient(90deg, #1a1a25, #252530, #1a1a25);
        }

        /* ============ NEON SIGNS ============ */
        .neon-sign {
            position: absolute;
            font-family: 'Orbitron', sans-serif;
            font-weight: 900;
            padding: 12px 24px;
            white-space: nowrap;
            z-index: 50;
            transform-style: preserve-3d;
            transition: transform 0.3s ease;
        }

        .sign-xl { font-size: 42px; letter-spacing: 4px; }
        .sign-lg { font-size: 28px; letter-spacing: 3px; }
        .sign-md { font-size: 18px; letter-spacing: 2px; }
        .sign-sm { font-size: 12px; }

        .sign-vertical {
            writing-mode: vertical-rl;
            text-orientation: mixed;
        }

        .neon-pink-sign {
            color: var(--neon-pink);
            text-shadow: 0 0 8px var(--neon-pink), 0 0 20px var(--neon-pink);
            border: 2px solid var(--neon-pink);
            box-shadow: 0 0 15px var(--neon-pink);
            background: rgba(255,42,109,0.1);
        }

        .neon-cyan-sign {
            color: var(--neon-cyan);
            text-shadow: 0 0 8px var(--neon-cyan), 0 0 20px var(--neon-cyan);
            border: 2px solid var(--neon-cyan);
            box-shadow: 0 0 15px var(--neon-cyan);
            background: rgba(5,217,232,0.1);
        }

        .neon-yellow-sign {
            color: var(--neon-yellow);
            text-shadow: 0 0 8px var(--neon-yellow), 0 0 20px var(--neon-yellow);
            border: 2px solid var(--neon-yellow);
            box-shadow: 0 0 15px var(--neon-yellow);
            background: rgba(249,240,2,0.1);
        }

        .neon-purple-sign {
            color: var(--neon-purple);
            text-shadow: 0 0 8px var(--neon-purple), 0 0 20px var(--neon-purple);
            border: 2px solid var(--neon-purple);
            box-shadow: 0 0 15px var(--neon-purple);
            background: rgba(211,0,197,0.1);
        }

        .neon-green-sign {
            color: var(--neon-green);
            text-shadow: 0 0 8px var(--neon-green), 0 0 20px var(--neon-green);
            border: 2px solid var(--neon-green);
            box-shadow: 0 0 15px var(--neon-green);
            background: rgba(57,255,20,0.1);
        }

        /* Flicker */
        @keyframes flicker {
            0%, 100% { opacity: 1; }
            41%, 43% { opacity: 0.8; }
            42% { opacity: 0.6; }
            45% { opacity: 1; }
        }
        .flicker { animation: flicker 3s infinite; }

        /* ============ FLYING VEHICLES ============ */
        .vehicle {
            position: absolute;
            z-index: 30;
        }

        .vehicle-body {
            width: 70px;
            height: 18px;
            background: linear-gradient(90deg, #111 0%, #222 50%, #111 100%);
            border-radius: 6px 30px 30px 6px;
            position: relative;
        }

        .vehicle-glow {
            position: absolute;
            right: -15px;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            height: 8px;
            background: var(--neon-pink);
            border-radius: 4px;
            box-shadow: 0 0 20px var(--neon-pink), 0 0 40px var(--neon-pink);
        }

        .vehicle-trail {
            position: absolute;
            right: 100%;
            top: 50%;
            transform: translateY(-50%);
            width: 180px;
            height: 3px;
            background: linear-gradient(90deg, transparent, var(--neon-cyan));
        }

        .vehicle-1 {
            top: 22%;
            animation: fly1 14s linear infinite;
        }

        .vehicle-2 {
            top: 28%;
            animation: fly2 11s linear infinite;
            animation-delay: -5s;
        }

        @keyframes fly1 {
            from { left: -150px; }
            to { left: calc(100% + 150px); }
        }

        @keyframes fly2 {
            from { right: -150px; left: auto; }
            to { right: calc(100% + 150px); left: auto; }
        }

        /* ============ RAIN ============ */
        .rain {
            position: absolute;
            inset: 0;
            pointer-events: none;
            z-index: 80;
        }

        .drop {
            position: absolute;
            width: 1px;
            height: 40px;
            background: linear-gradient(to bottom, transparent, var(--neon-cyan));
            opacity: 0.4;
            animation: fall 0.5s linear infinite;
        }

        @keyframes fall {
            from { transform: translateY(-50px); }
            to { transform: translateY(100vh); }
        }

        /* ============ FOG/ATMOSPHERE ============ */
        .fog {
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse at 50% 100%, rgba(255,42,109,0.08) 0%, transparent 60%),
                radial-gradient(ellipse at 30% 70%, rgba(5,217,232,0.06) 0%, transparent 50%),
                radial-gradient(ellipse at 70% 70%, rgba(211,0,197,0.06) 0%, transparent 50%);
            pointer-events: none;
            z-index: 40;
        }

        /* Scanlines - disabled for performance */
        .scanlines {
            display: none;
        }

        /* ============ HEADER ============ */
        header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            padding: 20px 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: linear-gradient(to bottom, rgba(0,0,0,0.9), transparent);
            z-index: 300;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .brand img {
            width: 40px;
            height: 40px;
            border: 2px solid var(--neon-cyan);
            border-radius: 6px;
            box-shadow: 0 0 15px var(--neon-cyan);
        }

        .brand span {
            font-family: 'Orbitron', sans-serif;
            font-size: 24px;
            font-weight: 900;
            color: var(--neon-cyan);
            text-shadow: 0 0 15px var(--neon-cyan);
            letter-spacing: 3px;
        }

        .nav a {
            margin-left: 20px;
            font-family: 'Orbitron', sans-serif;
            font-size: 11px;
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            letter-spacing: 2px;
            transition: all 0.3s;
        }

        .nav a:hover {
            color: var(--neon-cyan);
            text-shadow: 0 0 10px var(--neon-cyan);
        }

        /* ============ WELCOME ============ */
        .welcome {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            z-index: 150;
            transition: all 0.6s;
            pointer-events: none;
        }

        .welcome.hide {
            opacity: 0;
            transform: translate(-50%, -50%) scale(0.9);
        }

        .welcome h1 {
            font-family: 'Orbitron', sans-serif;
            font-size: clamp(32px, 8vw, 64px);
            font-weight: 900;
            letter-spacing: 8px;
            margin-bottom: 10px;
        }

        .welcome h1 .c1 {
            color: #fff;
            text-shadow: 0 0 20px var(--neon-cyan), 0 0 40px var(--neon-cyan);
        }

        .welcome h1 .c2 {
            color: var(--neon-pink);
            text-shadow: 0 0 20px var(--neon-pink), 0 0 40px var(--neon-pink);
        }

        .welcome p {
            font-family: 'Orbitron', sans-serif;
            font-size: 12px;
            color: rgba(255,255,255,0.5);
            letter-spacing: 4px;
            margin-bottom: 30px;
        }

        .scroll-hint {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
        }

        .scroll-hint span {
            font-family: 'Orbitron', sans-serif;
            font-size: 10px;
            color: var(--neon-cyan);
            letter-spacing: 3px;
        }

        .scroll-hint .arrow {
            width: 20px;
            height: 20px;
            border: 2px solid var(--neon-cyan);
            border-top: none;
            border-left: none;
            transform: rotate(45deg);
            animation: bounce 1.5s infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: rotate(45deg) translateY(0); }
            50% { transform: rotate(45deg) translateY(8px); }
        }

        /* ============ STORY PANELS ============ */
        .story-panel {
            position: fixed;
            width: 400px;
            max-width: 85vw;
            background: rgba(8, 2, 20, 0.95);
            backdrop-filter: blur(15px);
            border: 2px solid var(--neon-cyan);
            box-shadow: 0 0 50px rgba(5, 217, 232, 0.4);
            z-index: 180;
            opacity: 0;
            transform: translateY(40px) scale(0.95);
            transition: all 0.7s ease;
            pointer-events: none;
            left: 50%;
            top: 50%;
            margin-left: -200px;
            margin-top: -220px;
        }

        .story-panel.show {
            opacity: 1;
            transform: translateY(0) scale(1);
            pointer-events: auto;
        }

        .story-panel::before, .story-panel::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            border: 3px solid var(--neon-pink);
        }

        .story-panel::before {
            top: -2px;
            left: -2px;
            border-right: none;
            border-bottom: none;
        }

        .story-panel::after {
            bottom: -2px;
            right: -2px;
            border-left: none;
            border-top: none;
        }

        .panel-bar {
            height: 4px;
            background: linear-gradient(90deg, var(--neon-cyan), var(--neon-pink), var(--neon-cyan));
        }

        .panel-img {
            height: 160px;
            overflow: hidden;
            position: relative;
        }

        .panel-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s;
        }

        .story-panel:hover .panel-img img {
            transform: scale(1.1);
        }

        .panel-img::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, transparent 40%, rgba(8,2,20,0.98) 100%);
        }

        .panel-num {
            position: absolute;
            top: 10px;
            left: 10px;
            font-family: 'Orbitron', sans-serif;
            font-size: 28px;
            font-weight: 900;
            color: var(--neon-cyan);
            text-shadow: 0 0 15px var(--neon-cyan);
            z-index: 2;
        }

        .panel-cat {
            position: absolute;
            top: 10px;
            right: 10px;
            padding: 5px 12px;
            font-family: 'Orbitron', sans-serif;
            font-size: 9px;
            font-weight: 700;
            background: var(--neon-pink);
            color: #000;
            z-index: 2;
            clip-path: polygon(6px 0, 100% 0, calc(100% - 6px) 100%, 0 100%);
        }

        .panel-body {
            padding: 20px;
        }

        .panel-body h3 {
            font-family: 'Orbitron', sans-serif;
            font-size: 16px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 8px;
        }

        .panel-body p {
            font-size: 13px;
            color: rgba(255,255,255,0.6);
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .panel-body a {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            font-family: 'Orbitron', sans-serif;
            font-size: 10px;
            font-weight: 700;
            background: var(--neon-cyan);
            color: #000;
            text-decoration: none;
            clip-path: polygon(8px 0, 100% 0, calc(100% - 8px) 100%, 0 100%);
            box-shadow: 0 0 20px var(--neon-cyan);
            transition: all 0.3s;
        }

        .panel-body a:hover {
            background: var(--neon-pink);
            box-shadow: 0 0 25px var(--neon-pink);
        }

        /* ============ PROGRESS ============ */
        .progress-bar {
            position: fixed;
            right: 25px;
            top: 50%;
            transform: translateY(-50%);
            z-index: 250;
        }

        .progress-track {
            width: 3px;
            height: 140px;
            background: rgba(5, 217, 232, 0.2);
            border-radius: 3px;
        }

        .progress-fill {
            width: 100%;
            background: linear-gradient(to bottom, var(--neon-cyan), var(--neon-pink));
            border-radius: 3px;
            transition: height 0.2s;
            box-shadow: 0 0 10px var(--neon-cyan);
        }

        /* ============ HUD ============ */
        .hud {
            position: fixed;
            font-family: 'Orbitron', sans-serif;
            font-size: 9px;
            color: rgba(5, 217, 232, 0.6);
            letter-spacing: 2px;
            z-index: 250;
        }

        .hud-bl { bottom: 25px; left: 25px; }
        .hud-br { bottom: 25px; right: 25px; text-align: right; }

        /* ============ END ============ */
        .end-section {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 35px;
            background: linear-gradient(to top, rgba(0,0,0,0.95), transparent);
            text-align: center;
            z-index: 160;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.5s;
            pointer-events: none;
        }

        .end-section.show {
            opacity: 1;
            transform: translateY(0);
            pointer-events: auto;
        }

        .end-section h2 {
            font-family: 'Orbitron', sans-serif;
            font-size: 20px;
            color: var(--neon-cyan);
            text-shadow: 0 0 15px var(--neon-cyan);
            margin-bottom: 15px;
            letter-spacing: 4px;
        }

        .end-section a {
            display: inline-block;
            margin: 0 8px;
            padding: 10px 22px;
            font-family: 'Orbitron', sans-serif;
            font-size: 10px;
            font-weight: 700;
            text-decoration: none;
            clip-path: polygon(6px 0, 100% 0, calc(100% - 6px) 100%, 0 100%);
        }

        .end-section a.primary {
            background: var(--neon-cyan);
            color: #000;
        }

        .end-section a.secondary {
            background: transparent;
            color: var(--neon-pink);
            border: 2px solid var(--neon-pink);
        }

        /* ============ RESPONSIVE ============ */
        @media (max-width: 768px) {
            header { padding: 15px 20px; }
            .nav { display: none; }
            .left-buildings, .right-buildings { width: 30%; }
            .neon-sign { font-size: 60% !important; padding: 8px 12px; }
            .story-panel {
                width: 90vw;
                margin-left: -45vw;
                margin-top: -200px;
            }
            .hud { display: none; }
            .progress-bar { right: 10px; }
        }
    </style>
</head>
<body>
    <div class="viewport">
        <div class="scene" id="scene">
            <!-- GROUND -->
            <div class="ground-wrapper">
                <div class="ground" id="ground">
                    <div class="street-surface"></div>
                    <div class="asphalt"></div>
                    <div class="curb-left"></div>
                    <div class="curb-right"></div>
                    <div class="lane-left"></div>
                    <div class="lane-right"></div>
                    <div class="center-lines"></div>
                    <div class="road-markers">
                        <div class="road-marker" style="top: 5%;"></div>
                        <div class="road-marker" style="top: 25%;"></div>
                        <div class="road-marker" style="top: 45%;"></div>
                        <div class="road-marker" style="top: 65%;"></div>
                        <div class="road-marker" style="top: 85%;"></div>
                    </div>
                    <div class="puddle" style="left: 38%; top: 20%; width: 100px; height: 40px;"></div>
                    <div class="puddle" style="left: 55%; top: 45%; width: 80px; height: 35px;"></div>
                    <div class="puddle" style="left: 42%; top: 70%; width: 120px; height: 50px;"></div>
                    <div class="manhole" style="left: 48%; top: 35%;"></div>
                    <div class="manhole" style="left: 52%; top: 75%;"></div>
                </div>
            </div>

            <!-- LEFT BUILDINGS -->
            <div class="left-buildings" id="leftBuildings">
                <!-- Background building -->
                <div class="bldg bldg-left-4">
                    <div class="window-row" style="top: 2%; right: 10%;"><div class="window-box"></div><div class="window-box glow"></div></div>
                    <div class="window-row" style="top: 8%; right: 10%;"><div class="window-box glow-pink"></div><div class="window-box"></div></div>
                </div>
                <div class="bldg bldg-left-3">
                    <div class="window-row" style="top: 3%; right: 15%;"><div class="window-box"></div><div class="window-box glow"></div><div class="window-box"></div></div>
                    <div class="window-row" style="top: 9%; right: 15%;"><div class="window-box glow-pink"></div><div class="window-box"></div><div class="window-box"></div></div>
                    <div class="floor-line" style="top: 15%;"></div>
                    <div class="window-row" style="top: 18%; right: 15%;"><div class="window-box"></div><div class="window-box"></div><div class="window-box glow"></div></div>
                    <div class="window-row" style="top: 24%; right: 15%;"><div class="window-box glow-yellow"></div><div class="window-box"></div><div class="window-box"></div></div>
                </div>
                <div class="bldg bldg-left-2">
                    <div class="window-row" style="top: 5%; right: 10%;"><div class="window-box glow"></div><div class="window-box"></div><div class="window-box glow-yellow"></div><div class="window-box"></div></div>
                    <div class="floor-line" style="top: 12%;"></div>
                    <div class="window-row" style="top: 15%; right: 10%;"><div class="window-box"></div><div class="window-box glow-pink"></div><div class="window-box"></div><div class="window-box glow"></div></div>
                    <div class="window-row" style="top: 23%; right: 10%;"><div class="window-box"></div><div class="window-box"></div><div class="window-box glow"></div><div class="window-box"></div></div>
                    <div class="floor-line" style="top: 30%;"></div>
                    <div class="window-row" style="top: 34%; right: 10%;"><div class="window-box glow"></div><div class="window-box"></div><div class="window-box"></div><div class="window-box glow-pink"></div></div>
                    <div class="window-row" style="top: 42%; right: 10%;"><div class="window-box"></div><div class="window-box glow-yellow"></div><div class="window-box"></div><div class="window-box"></div></div>
                    <div class="ac-unit" style="right: 12%; top: 52%;"></div>
                    <div class="pipe" style="right: 3%; top: 20%; height: 180px;"></div>
                </div>
                <div class="bldg bldg-left-1">
                    <div class="window-row" style="top: 2%; right: 8%;"><div class="window-box glow-pink"></div><div class="window-box"></div><div class="window-box glow"></div><div class="window-box"></div><div class="window-box glow-yellow"></div></div>
                    <div class="floor-line" style="top: 8%;"></div>
                    <div class="window-row" style="top: 11%; right: 8%;"><div class="window-box"></div><div class="window-box glow"></div><div class="window-box"></div><div class="window-box glow-pink"></div><div class="window-box"></div></div>
                    <div class="window-row" style="top: 18%; right: 8%;"><div class="window-box glow"></div><div class="window-box"></div><div class="window-box glow"></div><div class="window-box"></div><div class="window-box glow-yellow"></div></div>
                    <div class="floor-line" style="top: 25%;"></div>
                    <div class="window-row" style="top: 28%; right: 8%;"><div class="window-box"></div><div class="window-box glow-pink"></div><div class="window-box"></div><div class="window-box glow"></div><div class="window-box"></div></div>
                    <div class="window-row" style="top: 35%; right: 8%;"><div class="window-box glow-yellow"></div><div class="window-box"></div><div class="window-box"></div><div class="window-box"></div><div class="window-box glow"></div></div>
                    <div class="floor-line" style="top: 42%;"></div>
                    <div class="window-row" style="top: 45%; right: 8%;"><div class="window-box"></div><div class="window-box"></div><div class="window-box glow-pink"></div><div class="window-box"></div><div class="window-box"></div></div>
                    <div class="window-row" style="top: 52%; right: 8%;"><div class="window-box glow"></div><div class="window-box glow-yellow"></div><div class="window-box"></div><div class="window-box glow"></div><div class="window-box"></div></div>
                    <div class="floor-line" style="top: 59%;"></div>
                    <div class="window-row" style="top: 62%; right: 8%;"><div class="window-box"></div><div class="window-box"></div><div class="window-box glow"></div><div class="window-box"></div><div class="window-box glow-pink"></div></div>
                    <div class="ac-unit" style="right: 6%; top: 70%;"></div>
                    <div class="ac-unit" style="right: 18%; top: 76%;"></div>
                    <div class="ac-unit" style="right: 30%; top: 82%;"></div>
                    <div class="pipe" style="right: 0; top: 10%; height: 250px;"></div>
                    <div class="pipe" style="right: 0; top: 55%; height: 120px;"></div>
                </div>

                <!-- NEON SIGNS LEFT -->
                <div class="neon-sign sign-xl neon-pink-sign flicker" style="right: -25%; top: 8%;">CYBER</div>
                <div class="neon-sign sign-lg neon-cyan-sign sign-vertical" style="right: 2%; top: 22%; padding: 25px 12px;">データ</div>
                <div class="neon-sign sign-md neon-yellow-sign" style="right: -15%; top: 38%;">RAMEN 24H</div>
                <div class="neon-sign sign-lg neon-purple-sign flicker" style="right: -8%; top: 55%;">酒場</div>
                <div class="neon-sign sign-sm neon-green-sign" style="right: 5%; top: 72%;">OPEN</div>
            </div>

            <!-- RIGHT BUILDINGS -->
            <div class="right-buildings" id="rightBuildings">
                <!-- Background building -->
                <div class="bldg bldg-right-4">
                    <div class="window-row" style="top: 2%; left: 10%;"><div class="window-box glow"></div><div class="window-box"></div></div>
                    <div class="window-row" style="top: 8%; left: 10%;"><div class="window-box"></div><div class="window-box glow-pink"></div></div>
                </div>
                <div class="bldg bldg-right-3">
                    <div class="window-row" style="top: 3%; left: 15%;"><div class="window-box"></div><div class="window-box glow-pink"></div><div class="window-box"></div></div>
                    <div class="window-row" style="top: 9%; left: 15%;"><div class="window-box glow"></div><div class="window-box"></div><div class="window-box glow-yellow"></div></div>
                    <div class="floor-line" style="top: 15%;"></div>
                    <div class="window-row" style="top: 18%; left: 15%;"><div class="window-box"></div><div class="window-box glow"></div><div class="window-box"></div></div>
                    <div class="window-row" style="top: 24%; left: 15%;"><div class="window-box glow-pink"></div><div class="window-box"></div><div class="window-box"></div></div>
                </div>
                <div class="bldg bldg-right-2">
                    <div class="window-row" style="top: 5%; left: 10%;"><div class="window-box glow-pink"></div><div class="window-box"></div><div class="window-box glow"></div><div class="window-box"></div></div>
                    <div class="floor-line" style="top: 12%;"></div>
                    <div class="window-row" style="top: 15%; left: 10%;"><div class="window-box"></div><div class="window-box glow-yellow"></div><div class="window-box"></div><div class="window-box glow"></div></div>
                    <div class="window-row" style="top: 23%; left: 10%;"><div class="window-box glow"></div><div class="window-box"></div><div class="window-box glow-pink"></div><div class="window-box"></div></div>
                    <div class="floor-line" style="top: 30%;"></div>
                    <div class="window-row" style="top: 34%; left: 10%;"><div class="window-box"></div><div class="window-box glow"></div><div class="window-box"></div><div class="window-box glow-yellow"></div></div>
                    <div class="window-row" style="top: 42%; left: 10%;"><div class="window-box glow-pink"></div><div class="window-box"></div><div class="window-box glow"></div><div class="window-box"></div></div>
                    <div class="ac-unit" style="left: 12%; top: 52%;"></div>
                    <div class="pipe" style="left: 3%; top: 20%; height: 180px;"></div>
                </div>
                <div class="bldg bldg-right-1">
                    <div class="window-row" style="top: 2%; left: 8%;"><div class="window-box"></div><div class="window-box glow"></div><div class="window-box glow-pink"></div><div class="window-box"></div><div class="window-box glow"></div></div>
                    <div class="floor-line" style="top: 8%;"></div>
                    <div class="window-row" style="top: 11%; left: 8%;"><div class="window-box glow-pink"></div><div class="window-box"></div><div class="window-box"></div><div class="window-box glow"></div><div class="window-box glow-yellow"></div></div>
                    <div class="window-row" style="top: 18%; left: 8%;"><div class="window-box"></div><div class="window-box glow"></div><div class="window-box glow-pink"></div><div class="window-box"></div><div class="window-box"></div></div>
                    <div class="floor-line" style="top: 25%;"></div>
                    <div class="window-row" style="top: 28%; left: 8%;"><div class="window-box glow-yellow"></div><div class="window-box"></div><div class="window-box"></div><div class="window-box glow-pink"></div><div class="window-box glow"></div></div>
                    <div class="window-row" style="top: 35%; left: 8%;"><div class="window-box"></div><div class="window-box glow"></div><div class="window-box"></div><div class="window-box"></div><div class="window-box glow-pink"></div></div>
                    <div class="floor-line" style="top: 42%;"></div>
                    <div class="window-row" style="top: 45%; left: 8%;"><div class="window-box glow"></div><div class="window-box"></div><div class="window-box glow-yellow"></div><div class="window-box glow"></div><div class="window-box"></div></div>
                    <div class="window-row" style="top: 52%; left: 8%;"><div class="window-box"></div><div class="window-box glow-pink"></div><div class="window-box"></div><div class="window-box"></div><div class="window-box glow"></div></div>
                    <div class="floor-line" style="top: 59%;"></div>
                    <div class="window-row" style="top: 62%; left: 8%;"><div class="window-box glow-pink"></div><div class="window-box glow"></div><div class="window-box"></div><div class="window-box glow-yellow"></div><div class="window-box"></div></div>
                    <div class="ac-unit" style="left: 6%; top: 70%;"></div>
                    <div class="ac-unit" style="left: 18%; top: 76%;"></div>
                    <div class="ac-unit" style="left: 30%; top: 82%;"></div>
                    <div class="pipe" style="left: 0; top: 10%; height: 250px;"></div>
                    <div class="pipe" style="left: 0; top: 55%; height: 120px;"></div>
                </div>

                <!-- NEON SIGNS RIGHT -->
                <div class="neon-sign sign-xl neon-purple-sign flicker" style="left: -20%; top: 8%;">NEON</div>
                <div class="neon-sign sign-lg neon-pink-sign sign-vertical" style="left: 2%; top: 22%; padding: 25px 12px;">夜市</div>
                <div class="neon-sign sign-md neon-cyan-sign" style="left: -12%; top: 38%;">TECH SHOP</div>
                <div class="neon-sign sign-lg neon-yellow-sign flicker" style="left: -5%; top: 52%;">クラブ</div>
                <div class="neon-sign sign-sm neon-orange" style="left: 5%; top: 68%; color: var(--neon-orange); text-shadow: 0 0 15px var(--neon-orange); border: 2px solid var(--neon-orange); box-shadow: 0 0 15px var(--neon-orange);">BAR</div>
                <div class="neon-sign sign-md neon-green-sign" style="left: -10%; top: 80%;">ホテル</div>
            </div>

            <!-- FLYING VEHICLES -->
            <div class="vehicle vehicle-1">
                <div class="vehicle-trail"></div>
                <div class="vehicle-body"><div class="vehicle-glow"></div></div>
            </div>
            <div class="vehicle vehicle-2">
                <div class="vehicle-trail"></div>
                <div class="vehicle-body"><div class="vehicle-glow"></div></div>
            </div>

            <!-- FOG -->
            <div class="fog"></div>
        </div>

        <!-- RAIN -->
        <div class="rain" id="rain"></div>
    </div>

    <div class="scanlines"></div>

    <!-- HEADER -->
    <header>
        <a href="/" class="brand">
            <img src="https://birimler.atauni.edu.tr/atabaum/wp-content/uploads/sites/17/2021/07/logo3.png" alt="BAUM">
            <span>BAUM</span>
        </a>
        <nav class="nav">
            <a href="/">HOME</a>
            <a href="/bilgilendirme-sayfa.html">ABOUT</a>
            <a href="/iletisim">CONTACT</a>
            <a href="/admin/login">ADMIN</a>
        </nav>
    </header>

    <!-- WELCOME -->
    <div class="welcome" id="welcome">
        <h1><span class="c1">NIGHT</span> <span class="c2">CITY</span></h1>
        <p>// SCROLL TO WALK //</p>
        <div class="scroll-hint">
            <span>ENTER THE STREETS</span>
            <div class="arrow"></div>
        </div>
    </div>

    <!-- PROGRESS -->
    <div class="progress-bar">
        <div class="progress-track">
            <div class="progress-fill" id="progressFill"></div>
        </div>
    </div>

    <!-- HUD -->
    <div class="hud hud-bl">DIST: <span id="hudDist">0</span>M</div>
    <div class="hud hud-br">SECTOR: <span id="hudSector">DOWNTOWN</span></div>

    <!-- SCROLL CONTAINER -->
    <div class="scroll-container">
        @foreach($stories as $i => $story)
        <div class="story-panel" data-trigger="{{ ($i + 1) * (100 / ($stories->count() + 1)) }}">
            <div class="panel-bar"></div>
            <div class="panel-img">
                <img src="{{ $story->cover_image_url ?? 'https://images.unsplash.com/photo-1573455494060-c5595004fb6c?w=800' }}" alt="">
                <span class="panel-num">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                @if($story->category)<span class="panel-cat">{{ $story->category }}</span>@endif
            </div>
            <div class="panel-body">
                <h3>{{ $story->title }}</h3>
                <p>{{ Str::limit($story->excerpt, 80) }}</p>
                <a href="{{ route('stories.show', $story->slug) }}">ACCESS →</a>
            </div>
        </div>
        @endforeach
    </div>

    <!-- END -->
    <div class="end-section" id="endSection">
        <h2>// END OF LINE //</h2>
        <a href="/iletisim" class="primary">CONTACT</a>
        <a href="#" class="secondary" onclick="scrollTo({top:0,behavior:'smooth'});return false;">RETURN</a>
    </div>

    <!-- Audio Control -->
    <button class="audio-toggle" id="audioToggle" title="Cyberpunk Ambience">
        <svg class="audio-on" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z"/>
        </svg>
        <svg class="audio-off" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2"/>
        </svg>
    </button>

    <!-- Cyberpunk Ambient Audio -->
    <audio id="bgMusic" loop preload="auto">
        <source src="https://assets.mixkit.co/music/preview/mixkit-driving-ambition-32.mp3" type="audio/mpeg">
        <source src="https://assets.mixkit.co/music/preview/mixkit-tech-house-vibes-130.mp3" type="audio/mpeg">
    </audio>

    <style>
        .audio-toggle {
            position: fixed;
            bottom: 25px;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 50px;
            background: rgba(8, 2, 20, 0.9);
            border: 2px solid var(--neon-cyan);
            border-radius: 50%;
            cursor: pointer;
            z-index: 300;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
            box-shadow: 0 0 20px rgba(5, 217, 232, 0.4);
        }
        .audio-toggle:hover {
            background: rgba(5, 217, 232, 0.2);
            box-shadow: 0 0 30px rgba(5, 217, 232, 0.6);
        }
        .audio-toggle svg {
            width: 24px;
            height: 24px;
            color: var(--neon-cyan);
        }
        .audio-toggle .audio-off { display: none; }
        .audio-toggle.playing .audio-on { display: none; }
        .audio-toggle.playing .audio-off { display: block; }
        .audio-toggle.playing {
            border-color: var(--neon-pink);
            box-shadow: 0 0 20px rgba(255, 42, 109, 0.5);
            animation: audioPulse 1s ease-in-out infinite;
        }
        .audio-toggle.playing svg { color: var(--neon-pink); }

        @keyframes audioPulse {
            0%, 100% { box-shadow: 0 0 20px rgba(255, 42, 109, 0.5); }
            50% { box-shadow: 0 0 35px rgba(255, 42, 109, 0.8); }
        }
    </style>

    <script>
        // ============ AUDIO PLAYER ============
        const audioToggle = document.getElementById('audioToggle');
        const bgMusic = document.getElementById('bgMusic');
        bgMusic.volume = 0.4;

        audioToggle.addEventListener('click', () => {
            if (bgMusic.paused) {
                bgMusic.play().then(() => {
                    audioToggle.classList.add('playing');
                }).catch(e => console.log('Audio play failed:', e));
            } else {
                bgMusic.pause();
                audioToggle.classList.remove('playing');
            }
        });

        // ============ MAIN CODE ============
        const welcome = document.getElementById('welcome');
        const progressFill = document.getElementById('progressFill');
        const panels = document.querySelectorAll('.story-panel');
        const endSection = document.getElementById('endSection');
        const hudDist = document.getElementById('hudDist');
        const hudSector = document.getElementById('hudSector');
        const leftBuildings = document.getElementById('leftBuildings');
        const rightBuildings = document.getElementById('rightBuildings');
        const rain = document.getElementById('rain');

        const sectors = ['DOWNTOWN', 'JAPANTOWN', 'WESTBROOK', 'HEYWOOD', 'PACIFICA'];

        // Create rain drops - minimal for performance
        for (let i = 0; i < 12; i++) {
            const drop = document.createElement('div');
            drop.className = 'drop';
            drop.style.left = (35 + Math.random() * 30) + '%';
            drop.style.animationDelay = (Math.random() * 0.5) + 's';
            rain.appendChild(drop);
        }

        const maxScroll = document.querySelector('.scroll-container').offsetHeight - window.innerHeight;
        let ticking = false;

        function update(scrollY) {
            const progress = Math.min(scrollY / maxScroll, 1);
            const pct = progress * 100;

            // Progress bar
            progressFill.style.height = (progress * 100) + '%';

            // Welcome fade out
            if (pct > 3) {
                welcome.style.opacity = '0';
                welcome.style.pointerEvents = 'none';
            } else {
                welcome.style.opacity = '1';
            }

            // ===== WALKING EFFECT - GPU accelerated =====
            const walkSpread = progress * 60;

            // Use translate3d for GPU acceleration
            leftBuildings.style.transform = `translate3d(${-walkSpread}px, 0, 0)`;
            rightBuildings.style.transform = `translate3d(${walkSpread}px, 0, 0)`;

            // HUD updates - throttled
            const dist = Math.floor(progress * 2000);
            if (hudDist.textContent !== String(dist)) {
                hudDist.textContent = dist;
            }

            const sectorIdx = Math.min(Math.floor(progress * sectors.length), sectors.length - 1);
            if (hudSector.textContent !== sectors[sectorIdx]) {
                hudSector.textContent = sectors[sectorIdx];
            }

            // Story panels
            panels.forEach(panel => {
                const trigger = parseFloat(panel.dataset.trigger);
                const show = pct >= trigger - 5 && pct <= trigger + 18;
                if (show && !panel.classList.contains('show')) {
                    panel.classList.add('show');
                } else if (!show && panel.classList.contains('show')) {
                    panel.classList.remove('show');
                }
            });

            // End section
            if (pct > 90 && !endSection.classList.contains('show')) {
                endSection.classList.add('show');
            } else if (pct <= 90 && endSection.classList.contains('show')) {
                endSection.classList.remove('show');
            }
        }

        // Smooth scroll handling
        window.addEventListener('scroll', () => {
            if (!ticking) {
                requestAnimationFrame(() => {
                    update(window.scrollY);
                    ticking = false;
                });
                ticking = true;
            }
        }, { passive: true });

        // Initial state
        update(0);

        // Keyboard controls
        document.addEventListener('keydown', e => {
            if (e.key === 'ArrowDown' || e.key === 's') scrollBy({top: 200, behavior: 'smooth'});
            if (e.key === 'ArrowUp' || e.key === 'w') scrollBy({top: -200, behavior: 'smooth'});
        });
    </script>
</body>
</html>

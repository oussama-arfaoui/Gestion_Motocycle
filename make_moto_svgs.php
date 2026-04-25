<?php
/**
 * Motorcycle Theme SVG Generator — Creative Edition
 * 10 unique visual designs, 5 variants each
 */
define('OUT', __DIR__ . '/public/storage/uploads/store_theme');

$THEMES = [
    'theme1'  => ['p'=>'#c0001a','ac'=>'#ff3333','bg'=>'#090909','card'=>'#161616','txt'=>'#ffffff','sub'=>'#bbbbbb','style'=>'dark',    'variants'=>['e53935','ff5252','d32f2f','ff1744','b71c1c'],'name'=>'Sport Racing'],
    'theme2'  => ['p'=>'#1565c0','ac'=>'#42a5f5','bg'=>'#f5f7fa','card'=>'#ffffff','txt'=>'#0d1b2a','sub'=>'#666666','style'=>'clean',   'variants'=>['1565c0','1976d2','0d47a1','01579b','0288d1'],'name'=>'Urban Modern'],
    'theme3'  => ['p'=>'#5d3a1a','ac'=>'#c89a5a','bg'=>'#fdf6e3','card'=>'#fff9f0','txt'=>'#3e2723','sub'=>'#8d6e63','style'=>'vintage', 'variants'=>['c89a5a','8d6e63','a1887f','795548','6d4c41'],'name'=>'Vintage Garage'],
    'theme4'  => ['p'=>'#1a1a1a','ac'=>'#ffd600','bg'=>'#0e0e0e','card'=>'#1e1e1e','txt'=>'#ffffff','sub'=>'#999999','style'=>'luxury',  'variants'=>['ffd600','ffab00','ff8f00','ffa000','ffca28'],'name'=>'Dark Premium'],
    'theme5'  => ['p'=>'#bf360c','ac'=>'#ff6d00','bg'=>'#ffffff','card'=>'#fff8f5','txt'=>'#1a0a00','sub'=>'#666666','style'=>'energy',  'variants'=>['ff6d00','ff3d00','f4511e','e64a19','d84315'],'name'=>'Sport Energy'],
    'theme6'  => ['p'=>'#2e7d32','ac'=>'#66bb6a','bg'=>'#f1f8e9','card'=>'#ffffff','txt'=>'#1b2e1c','sub'=>'#555555','style'=>'eco',     'variants'=>['43a047','2e7d32','388e3c','1b5e20','00897b'],'name'=>'Eco Adventure'],
    'theme7'  => ['p'=>'#0d001a','ac'=>'#d500f9','bg'=>'#06000f','card'=>'#110020','txt'=>'#f0e6ff','sub'=>'#bb99cc','style'=>'neon',    'variants'=>['d500f9','aa00ff','7c4dff','651fff','9c27b0'],'name'=>'Neon Night'],
    'theme8'  => ['p'=>'#01579b','ac'=>'#00b0ff','bg'=>'#e3f2fd','card'=>'#ffffff','txt'=>'#00234e','sub'=>'#546e7a','style'=>'ocean',   'variants'=>['0288d1','0091ea','00b0ff','006064','00acc1'],'name'=>'Ocean Blue'],
    'theme9'  => ['p'=>'#1a0038','ac'=>'#9c27b0','bg'=>'#0a0015','card'=>'#160025','txt'=>'#e8d5ff','sub'=>'#aa88cc','style'=>'royal',   'variants'=>['9c27b0','7b1fa2','6a1b9a','4a148c','ab47bc'],'name'=>'Royal Purple'],
    'theme10' => ['p'=>'#e65100','ac'=>'#ff9100','bg'=>'#fff8e1','card'=>'#fffaf0','txt'=>'#3e1c00','sub'=>'#795548','style'=>'desert',  'variants'=>['ff9100','ff6d00','ef6c00','e65100','bf360c'],'name'=>'Desert Sunset'],
];

function adj(string $hex, int $d): string {
    $hex = ltrim($hex,'#');
    if(strlen($hex)===3) $hex=$hex[0].$hex[0].$hex[1].$hex[1].$hex[2].$hex[2];
    $r=max(0,min(255,hexdec(substr($hex,0,2))+$d));
    $g=max(0,min(255,hexdec(substr($hex,2,2))+$d));
    $b=max(0,min(255,hexdec(substr($hex,4,2))+$d));
    return sprintf('#%02x%02x%02x',$r,$g,$b);
}

// ── Motorcycle drawings ──────────────────────────────────────────────────
function motoSport(string $c, string $a): string {
    $d=adj($c,-40); $l=adj($c,60);
    return '<ellipse cx="0" cy="52" rx="130" ry="7" fill="rgba(0,0,0,0.3)"/>'.
    '<circle cx="-82" cy="35" r="35" fill="#0e0e0e" stroke="#222" stroke-width="2"/>'.
    '<circle cx="-82" cy="35" r="24" fill="none" stroke="#333" stroke-width="2"/>'.
    '<circle cx="-82" cy="35" r="8" fill="#555"/>'.
    '<line x1="-82" y1="1" x2="-82" y2="69" stroke="#444" stroke-width="1.5"/>'.
    '<line x1="-48" y1="35" x2="-116" y2="35" stroke="#444" stroke-width="1.5"/>'.
    '<line x1="-57" y1="10" x2="-107" y2="60" stroke="#444" stroke-width="1.5"/>'.
    '<line x1="-107" y1="10" x2="-57" y2="60" stroke="#444" stroke-width="1.5"/>'.
    '<circle cx="-82" cy="35" r="15" fill="none" stroke="#555" stroke-width="3" stroke-dasharray="6 3"/>'.
    '<circle cx="82" cy="35" r="30" fill="#0e0e0e" stroke="#222" stroke-width="2"/>'.
    '<circle cx="82" cy="35" r="20" fill="none" stroke="#333" stroke-width="2"/>'.
    '<circle cx="82" cy="35" r="7" fill="#555"/>'.
    '<line x1="82" y1="5" x2="82" y2="65" stroke="#444" stroke-width="1.5"/>'.
    '<line x1="52" y1="35" x2="112" y2="35" stroke="#444" stroke-width="1.5"/>'.
    '<line x1="61" y1="14" x2="103" y2="56" stroke="#444" stroke-width="1.5"/>'.
    '<line x1="103" y1="14" x2="61" y2="56" stroke="#444" stroke-width="1.5"/>'.
    '<circle cx="82" cy="35" r="13" fill="none" stroke="#555" stroke-width="2.5" stroke-dasharray="5 3"/>'.
    '<path d="M-72 18 Q-35 5 0 4 Q12 4 22 0" fill="none" stroke="#3a3a3a" stroke-width="6" stroke-linecap="round"/>'.
    '<path d="M22 0 L52 -24 Q60 -28 66 -26" fill="none" stroke="'.$c.'" stroke-width="8" stroke-linecap="round"/>'.
    '<path d="M-18 -2 L18 -6 L55 -6 L72 5 L70 18 L55 22 L15 18 L-18 14 Z" fill="'.$a.'" stroke="'.$d.'" stroke-width="1.5"/>'.
    '<path d="M12 -6 L40 -22 L65 -20 L78 -10 L76 6 L68 8 L48 5 L18 5 Z" fill="'.$c.'" stroke="'.$d.'" stroke-width="1.5"/>'.
    '<path d="M40 -22 L62 -28 L80 -18 L78 -10 L65 -16 L45 -18 Z" fill="'.$d.'"/>'.
    '<path d="M44 -26 L60 -28 L76 -20 L70 -14 L50 -17 Z" fill="rgba(100,200,255,0.2)" stroke="rgba(200,240,255,0.5)" stroke-width="0.8"/>'.
    '<rect x="72" y="-18" width="14" height="10" rx="3" fill="#1a1a1a"/>'.
    '<rect x="73" y="-17" width="5" height="4" rx="1" fill="rgba(255,220,80,0.9)"/>'.
    '<rect x="80" y="-17" width="5" height="7" rx="1" fill="rgba(200,235,255,0.85)"/>'.
    '<path d="M18 -18 Q32 -30 54 -24 Q60 -18 58 -12 Q44 -17 20 -13 Z" fill="'.$c.'" stroke="'.$d.'" stroke-width="1"/>'.
    '<path d="M28 -20 Q40 -27 53 -23 Q44 -18 28 -17 Z" fill="'.$l.'" opacity="0.3"/>'.
    '<path d="M-6 -18 Q14 -28 40 -23 Q44 -19 40 -16 Q18 -24 -4 -15 Z" fill="#181818" stroke="#333"/>'.
    '<path d="M-20 -10 L-6 -18 L-3 -14 L-17 -6 Z" fill="'.$a.'"/>'.
    '<rect x="-22" y="-12" width="6" height="4" rx="1" fill="#ff2200" opacity="0.85"/>'.
    '<rect x="8" y="5" width="30" height="20" rx="3" fill="#252525" stroke="#333"/>'.
    '<path d="M8 22 L-18 26 L-48 29 Q-64 31 -75 36" fill="none" stroke="#aaa" stroke-width="6" stroke-linecap="round"/>'.
    '<path d="M8 22 L-18 26 L-48 29 Q-64 31 -75 36" fill="none" stroke="rgba(255,255,255,0.2)" stroke-width="3" stroke-linecap="round"/>'.
    '<ellipse cx="-78" cy="36" rx="5" ry="3" fill="rgba(255,120,0,0.5)"/>'.
    '<line x1="52" y1="-26" x2="74" y2="8" stroke="#666" stroke-width="5" stroke-linecap="round"/>'.
    '<line x1="59" y1="-26" x2="81" y2="8" stroke="#888" stroke-width="4" stroke-linecap="round"/>'.
    '<path d="M46 -30 Q53 -38 60 -28" fill="none" stroke="#555" stroke-width="3.5" stroke-linecap="round"/>'.
    '<circle cx="45" cy="-29" r="2.5" fill="#777"/>'.
    '<circle cx="61" cy="-27" r="2.5" fill="#777"/>';
}

function motoCruiser(string $c, string $a): string {
    $d=adj($c,-40); $l=adj($c,70);
    return '<ellipse cx="5" cy="56" rx="140" ry="7" fill="rgba(0,0,0,0.3)"/>'.
    '<circle cx="-88" cy="38" r="36" fill="#0e0e0e" stroke="#333" stroke-width="2"/>'.
    '<circle cx="-88" cy="38" r="26" fill="none" stroke="#3a3a3a" stroke-width="2.5"/>'.
    '<circle cx="-88" cy="38" r="9" fill="#666"/>'.
    '<line x1="-88" y1="2" x2="-88" y2="74" stroke="#444" stroke-width="1.5"/>'.
    '<line x1="-52" y1="38" x2="-124" y2="38" stroke="#444" stroke-width="1.5"/>'.
    '<line x1="-63" y1="13" x2="-113" y2="63" stroke="#444" stroke-width="1.5"/>'.
    '<line x1="-113" y1="13" x2="-63" y2="63" stroke="#444" stroke-width="1.5"/>'.
    '<circle cx="80" cy="40" r="28" fill="#0e0e0e" stroke="#333" stroke-width="2"/>'.
    '<circle cx="80" cy="40" r="20" fill="none" stroke="#3a3a3a" stroke-width="2"/>'.
    '<circle cx="80" cy="40" r="7" fill="#666"/>'.
    '<line x1="80" y1="12" x2="80" y2="68" stroke="#444" stroke-width="1.5"/>'.
    '<line x1="52" y1="40" x2="108" y2="40" stroke="#444" stroke-width="1.5"/>'.
    '<path d="M-80 22 Q-40 12 0 12 Q30 12 55 8" fill="none" stroke="#3a3a3a" stroke-width="8" stroke-linecap="round"/>'.
    '<path d="M0 12 L20 -2 L42 -4 Q52 -4 56 0" fill="none" stroke="'.$c.'" stroke-width="7" stroke-linecap="round"/>'.
    '<path d="M-50 -2 L-20 -8 L40 -8 L70 8 L68 28 L48 32 L-30 28 L-50 14 Z" fill="'.$c.'" stroke="'.$d.'" stroke-width="1.5"/>'.
    '<path d="M-48 -2 L-18 -8 L42 -6 L44 -2 Z" fill="'.$l.'" opacity="0.2"/>'.
    '<rect x="60" y="-5" width="20" height="14" rx="7" fill="#1a1a1a" stroke="#555" stroke-width="1.5"/>'.
    '<ellipse cx="70" cy="2" rx="7" ry="5" fill="rgba(255,220,80,0.7)"/>'.
    '<path d="M-10 -8 Q10 -20 38 -12 Q42 -6 38 -4 Q14 -12 -8 -4 Z" fill="'.$c.'" stroke="'.$d.'" stroke-width="1"/>'.
    '<path d="M-40 -4 Q-20 -16 10 -10 L8 -6 Q-18 -12 -38 -2 Z" fill="#1a1a1a" stroke="#333"/>'.
    '<path d="M-55 10 Q-48 0 -40 -4 L-38 -2 Q-46 2 -52 12 Z" fill="'.$a.'" stroke="'.$d.'" stroke-width="0.5"/>'.
    '<rect x="-57" y="8" width="10" height="5" rx="2" fill="#ff1100" opacity="0.7"/>'.
    '<rect x="-20" y="8" width="40" height="18" rx="3" fill="#222" stroke="#333"/>'.
    '<path d="M-18 24 Q-40 30 -60 34 Q-70 36 -78 40" fill="none" stroke="#bbb" stroke-width="7" stroke-linecap="round"/>'.
    '<line x1="44" y1="-10" x2="68" y2="14" stroke="#888" stroke-width="5" stroke-linecap="round"/>'.
    '<line x1="50" y1="-10" x2="74" y2="14" stroke="#999" stroke-width="4" stroke-linecap="round"/>'.
    '<path d="M36 -14 Q42 -20 50 -12" fill="none" stroke="#666" stroke-width="4" stroke-linecap="round"/>'.
    '<circle cx="35" cy="-13" r="3" fill="#888"/>';
}

function motoTrail(string $c, string $a): string {
    $d=adj($c,-40); $l=adj($c,60);
    return '<ellipse cx="0" cy="58" rx="125" ry="7" fill="rgba(0,0,0,0.25)"/>'.
    '<circle cx="-78" cy="40" r="36" fill="#111" stroke="#333" stroke-width="2"/>'.
    '<circle cx="-78" cy="40" r="25" fill="none" stroke="#3a3a3a" stroke-width="2"/>'.
    '<circle cx="-78" cy="40" r="8" fill="#555"/>'.
    '<line x1="-78" y1="4" x2="-78" y2="76" stroke="#3a3a3a" stroke-width="2"/>'.
    '<line x1="-42" y1="40" x2="-114" y2="40" stroke="#3a3a3a" stroke-width="2"/>'.
    '<line x1="-53" y1="15" x2="-103" y2="65" stroke="#3a3a3a" stroke-width="2"/>'.
    '<line x1="-103" y1="15" x2="-53" y2="65" stroke="#3a3a3a" stroke-width="2"/>'.
    '<circle cx="-78" cy="40" r="15" fill="none" stroke="#4a4a4a" stroke-width="3" stroke-dasharray="5 2"/>'.
    '<circle cx="78" cy="38" r="34" fill="#111" stroke="#333" stroke-width="2"/>'.
    '<circle cx="78" cy="38" r="23" fill="none" stroke="#3a3a3a" stroke-width="2"/>'.
    '<circle cx="78" cy="38" r="8" fill="#555"/>'.
    '<line x1="78" y1="4" x2="78" y2="72" stroke="#3a3a3a" stroke-width="2"/>'.
    '<line x1="44" y1="38" x2="112" y2="38" stroke="#3a3a3a" stroke-width="2"/>'.
    '<line x1="54" y1="14" x2="102" y2="62" stroke="#3a3a3a" stroke-width="2"/>'.
    '<line x1="102" y1="14" x2="54" y2="62" stroke="#3a3a3a" stroke-width="2"/>'.
    '<path d="M-68 24 Q-30 8 8 6" fill="none" stroke="#3a3a3a" stroke-width="7" stroke-linecap="round"/>'.
    '<path d="M8 6 L38 -18 Q46 -24 54 -22" fill="none" stroke="'.$c.'" stroke-width="8" stroke-linecap="round"/>'.
    '<path d="M-10 2 L22 -4 L50 -6 L68 6 L65 24 L45 28 L5 24 L-10 16 Z" fill="'.$c.'" stroke="'.$d.'" stroke-width="1.5"/>'.
    '<path d="M22 -4 L46 -18 L64 -14 L66 -4 L52 -6 L28 -2 Z" fill="'.$a.'" stroke="'.$d.'" stroke-width="1.5"/>'.
    '<rect x="58" y="-14" width="16" height="12" rx="3" fill="#1a1a1a"/>'.
    '<rect x="60" y="-12" width="6" height="5" rx="1" fill="rgba(255,220,80,0.9)"/>'.
    '<path d="M5 -16 Q22 -28 44 -20 Q48 -14 44 -10 Q26 -18 6 -12 Z" fill="'.$c.'" stroke="'.$d.'" stroke-width="1"/>'.
    '<path d="M-8 -12 Q10 -26 34 -20 Q36 -16 34 -14 Q12 -22 -6 -10 Z" fill="#1a1a1a" stroke="#333"/>'.
    '<path d="M-18 -2 L-8 -12 L-5 -9 L-14 0 Z" fill="'.$a.'"/>'.
    '<rect x="-20" y="-4" width="7" height="5" rx="1" fill="#ff1100" opacity="0.8"/>'.
    '<rect x="2" y="6" width="28" height="20" rx="3" fill="#222" stroke="#333"/>'.
    '<path d="M2 24 L-18 30 L-45 33 Q-60 36 -72 40" fill="none" stroke="#aaa" stroke-width="6" stroke-linecap="round"/>'.
    '<line x1="42" y1="-26" x2="65" y2="6" stroke="#555" stroke-width="6" stroke-linecap="round"/>'.
    '<line x1="50" y1="-26" x2="73" y2="6" stroke="#888" stroke-width="4" stroke-linecap="round"/>'.
    '<path d="M34 -28 Q42 -38 52 -24" fill="none" stroke="#666" stroke-width="4" stroke-linecap="round"/>'.
    '<circle cx="33" cy="-27" r="3" fill="#888"/>'.
    '<circle cx="53" cy="-23" r="3" fill="#888"/>';
}

function motoClassic(string $c, string $a): string {
    $d=adj($c,-30); $l=adj($c,50);
    return '<ellipse cx="0" cy="54" rx="120" ry="7" fill="rgba(0,0,0,0.2)"/>'.
    '<circle cx="-76" cy="36" r="34" fill="#1a1206" stroke="#3a2a12" stroke-width="2.5"/>'.
    '<circle cx="-76" cy="36" r="24" fill="none" stroke="#4a3a1a" stroke-width="2"/>'.
    '<circle cx="-76" cy="36" r="8" fill="#8a7a5a"/>'.
    '<line x1="-76" y1="2" x2="-76" y2="70" stroke="#5a4a2a" stroke-width="2"/>'.
    '<line x1="-42" y1="36" x2="-110" y2="36" stroke="#5a4a2a" stroke-width="2"/>'.
    '<line x1="-52" y1="12" x2="-100" y2="60" stroke="#5a4a2a" stroke-width="2"/>'.
    '<line x1="-100" y1="12" x2="-52" y2="60" stroke="#5a4a2a" stroke-width="2"/>'.
    '<circle cx="72" cy="36" r="32" fill="#1a1206" stroke="#3a2a12" stroke-width="2.5"/>'.
    '<circle cx="72" cy="36" r="22" fill="none" stroke="#4a3a1a" stroke-width="2"/>'.
    '<circle cx="72" cy="36" r="8" fill="#8a7a5a"/>'.
    '<line x1="72" y1="4" x2="72" y2="68" stroke="#5a4a2a" stroke-width="2"/>'.
    '<line x1="40" y1="36" x2="104" y2="36" stroke="#5a4a2a" stroke-width="2"/>'.
    '<path d="M-65 20 Q-30 8 5 8 Q20 8 35 4" fill="none" stroke="#5a4a2a" stroke-width="7" stroke-linecap="round"/>'.
    '<path d="M5 8 L28 -10 Q36 -16 44 -14" fill="none" stroke="'.$c.'" stroke-width="7" stroke-linecap="round"/>'.
    '<path d="M-20 4 L10 -4 L42 -6 L60 4 L58 20 L35 24 L-15 20 Z" fill="'.$c.'" stroke="'.$d.'" stroke-width="2"/>'.
    '<ellipse cx="20" cy="-8" rx="20" ry="8" fill="'.$c.'" stroke="'.$d.'" stroke-width="1.5"/>'.
    '<path d="M4 -6 Q18 -14 34 -8 Q24 -4 6 -4 Z" fill="rgba(255,255,255,0.15)"/>'.
    '<ellipse cx="62" cy="0" rx="12" ry="10" fill="#2a2010" stroke="#8a7a5a" stroke-width="2"/>'.
    '<ellipse cx="62" cy="0" rx="7" ry="6" fill="rgba(255,220,80,0.6)"/>'.
    '<path d="M-12 -6 Q4 -18 28 -12 Q32 -8 28 -4 Q8 -14 -10 -4 Z" fill="#1a1206" stroke="#3a2a12"/>'.
    '<path d="M-24 6 L-12 -6 L-9 -3 L-20 8 Z" fill="'.$a.'"/>'.
    '<rect x="-26" y="4" width="8" height="5" rx="1" fill="#cc1100" opacity="0.8"/>'.
    '<rect x="-5" y="8" width="28" height="18" rx="3" fill="#2a2010" stroke="#4a3a1a" stroke-width="1.5"/>'.
    '<path d="M-2 22 L-22 28 Q-45 32 -70 36" fill="none" stroke="#aaa" stroke-width="7" stroke-linecap="round"/>'.
    '<line x1="34" y1="-18" x2="56" y2="8" stroke="#8a7a5a" stroke-width="5" stroke-linecap="round"/>'.
    '<line x1="42" y1="-18" x2="64" y2="8" stroke="#aaa" stroke-width="3.5" stroke-linecap="round"/>'.
    '<path d="M28 -22 Q35 -32 44 -18" fill="none" stroke="#8a7a5a" stroke-width="4" stroke-linecap="round"/>';
}

// ── Choose moto by style ─────────────────────────────────
function getMoto(string $style, string $c, string $a): string {
    return match($style) {
        'vintage','desert' => motoClassic($c,$a),
        'luxury','ocean'   => motoCruiser($c,$a),
        'eco','energy'     => motoTrail($c,$a),
        default            => motoSport($c,$a),
    };
}

// ── Layout: DARK / NEON / ROYAL ─────────────────────────
function svgDark(string $p,string $pd,string $pl,string $bg,string $card,string $txt,string $sub,string $moto,int $vi,string $nm,string $style): string {
    $o  = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
    $o .= '<svg width="400" height="560" xmlns="http://www.w3.org/2000/svg"><defs>';
    $o .= '<linearGradient id="hg'.$vi.'" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" stop-color="'.$bg.'"/><stop offset="100%" stop-color="'.$p.'" stop-opacity="0.7"/></linearGradient>';
    $o .= '<radialGradient id="sp'.$vi.'" cx="70%" cy="40%" r="60%"><stop offset="0%" stop-color="'.$p.'" stop-opacity="0.25"/><stop offset="100%" stop-color="'.$bg.'" stop-opacity="0"/></radialGradient>';
    if($style==='neon') $o.='<filter id="gl"><feGaussianBlur stdDeviation="3" result="b"/><feMerge><feMergeNode in="b"/><feMergeNode in="SourceGraphic"/></feMerge></filter>';
    $o .= '</defs>';
    $o .= '<rect width="400" height="560" fill="'.$bg.'"/>';
    $o .= '<rect y="0" width="400" height="260" fill="url(#hg'.$vi.')"/>';
    $o .= '<circle cx="290" cy="150" r="180" fill="url(#sp'.$vi.')"/>';
    // Road stripe
    $o .= '<rect y="390" width="400" height="60" fill="'.adj($bg,8).'"/>';
    $o .= '<line x1="0" y1="418" x2="400" y2="418" stroke="'.$p.'" stroke-width="1" stroke-dasharray="20 10" opacity="0.3"/>';
    // NAV
    $o .= '<rect width="400" height="38" fill="'.$card.'" opacity="0.95"/>';
    $o .= '<rect x="14" y="12" width="22" height="14" rx="3" fill="'.$p.'"/>';
    $o .= '<text x="42" y="24" font-family="Arial,sans-serif" font-size="12" font-weight="bold" fill="'.$txt.'">MOTO</text>';
    $o .= '<text x="73" y="24" font-family="Arial,sans-serif" font-size="12" font-weight="bold" fill="'.$p.'">STORE</text>';
    $o .= '<text x="160" y="24" font-family="Arial,sans-serif" font-size="8" fill="'.$sub.'">Motos</text>';
    $o .= '<text x="202" y="24" font-family="Arial,sans-serif" font-size="8" fill="'.$sub.'">Equipements</text>';
    $o .= '<text x="290" y="24" font-family="Arial,sans-serif" font-size="8" fill="'.$sub.'">Pieces</text>';
    $o .= '<rect x="342" y="12" width="44" height="16" rx="8" fill="'.$p.'"/>';
    $o .= '<text x="364" y="24" font-family="Arial,sans-serif" font-size="7" font-weight="bold" fill="white" text-anchor="middle">Contact</text>';
    // HERO TEXT
    $o .= '<text x="20" y="76" font-family="Arial,sans-serif" font-size="7" fill="'.$p.'" letter-spacing="4">PERFORMANCE EXTREME</text>';
    $o .= '<text x="20" y="104" font-family="Arial,sans-serif" font-size="24" font-weight="bold" fill="'.$txt.'">VITESSE</text>';
    $o .= '<text x="20" y="128" font-family="Arial,sans-serif" font-size="24" font-weight="bold" fill="'.$p.'">EXTREME</text>';
    $o .= '<text x="20" y="150" font-family="Arial,sans-serif" font-size="9" fill="'.$sub.'">La collection la plus puissante de motos sport</text>';
    $o .= '<rect x="20" y="160" width="115" height="28" rx="14" fill="'.$p.'"/>';
    $o .= '<text x="77" y="178" font-family="Arial,sans-serif" font-size="9" font-weight="bold" fill="white" text-anchor="middle">Voir collection</text>';
    $o .= '<rect x="144" y="160" width="80" height="28" rx="14" fill="none" stroke="'.$p.'" stroke-width="1.5"/>';
    $o .= '<text x="184" y="178" font-family="Arial,sans-serif" font-size="9" fill="'.$p.'" text-anchor="middle">En savoir +</text>';
    // MOTO on right
    $o .= '<g transform="translate(290,390) scale(1.1)">'.$moto.'</g>';
    // STATS BAR
    $o .= '<rect y="248" width="400" height="38" fill="'.$p.'" opacity="0.9"/>';
    foreach(['250+ Motos'=>'50','15 Marques'=>'150','Livraison Express'=>'255','Garantie 2 ans'=>'355'] as $lbl=>$x)
        $o .= '<text x="'.$x.'" y="271" font-family="Arial,sans-serif" font-size="8" font-weight="bold" fill="white" text-anchor="middle">✓ '.$lbl.'</text>';
    // PRODUCTS
    $o .= '<text x="20" y="308" font-family="Arial,sans-serif" font-size="13" font-weight="bold" fill="'.$txt.'">Meilleures Ventes</text>';
    $o .= '<rect x="20" y="312" width="60" height="2" rx="1" fill="'.$p.'"/>';
    $names=['CBR 600RR','Ninja ZX-6','GSX-R750']; $prices=['89 900','74 500','82 000'];
    for($i=0;$i<3;$i++){
        $cx=10+$i*130;
        $o .= '<rect x="'.$cx.'" y="320" width="122" height="118" rx="8" fill="'.$card.'"/>';
        $o .= '<rect x="'.$cx.'" y="320" width="122" height="64" rx="8" fill="'.$p.'" opacity="0.15"/>';
        $o .= '<rect x="'.$cx.'" y="370" width="122" height="14" fill="'.$card.'"/>';
        $o .= '<g transform="translate('.($cx+60).', 352) scale(0.34)">'.$moto.'</g>';
        $o .= '<text x="'.($cx+61).'" y="396" font-family="Arial,sans-serif" font-size="8" font-weight="bold" fill="'.$txt.'" text-anchor="middle">'.$names[$i].'</text>';
        $o .= '<text x="'.($cx+61).'" y="409" font-family="Arial,sans-serif" font-size="9" font-weight="bold" fill="'.$p.'" text-anchor="middle">'.$prices[$i].' DH</text>';
        $o .= '<rect x="'.($cx+16).'" y="416" width="90" height="14" rx="7" fill="'.$p.'"/>';
        $o .= '<text x="'.($cx+61).'" y="427" font-family="Arial,sans-serif" font-size="7" fill="white" text-anchor="middle">Ajouter au panier</text>';
    }
    // PROMO
    $o .= '<rect y="450" width="400" height="38" fill="'.$p.'"/>';
    $o .= '<text x="200" y="464" font-family="Arial,sans-serif" font-size="10" font-weight="bold" fill="white" text-anchor="middle">Livraison GRATUITE pour toute commande +5000 DH</text>';
    $o .= '<text x="200" y="479" font-family="Arial,sans-serif" font-size="8" fill="rgba(255,255,255,0.7)" text-anchor="middle">Satisfait ou remboursé · Paiement sécurisé</text>';
    // FOOTER
    $o .= '<rect y="488" width="400" height="72" fill="'.adj($bg,-5).'"/>';
    $o .= '<text x="20" y="510" font-family="Arial,sans-serif" font-size="10" font-weight="bold" fill="'.$p.'">MOTO STORE</text>';
    $o .= '<text x="20" y="526" font-family="Arial,sans-serif" font-size="7" fill="'.$sub.'">© 2025 – Tous droits réservés</text>';
    $o .= '<text x="200" y="518" font-family="Arial,sans-serif" font-size="7" fill="'.$sub.'" text-anchor="middle">'.$nm.'</text>';
    $o .= '</svg>';
    return $o;
}

// ── Layout: CLEAN / OCEAN ────────────────────────────────
function svgClean(string $p,string $pd,string $pl,string $bg,string $card,string $txt,string $sub,string $moto,int $vi,string $nm): string {
    $o  = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
    $o .= '<svg width="400" height="560" xmlns="http://www.w3.org/2000/svg"><defs>';
    $o .= '<linearGradient id="hg'.$vi.'" x1="0%" y1="0%" x2="60%" y2="100%"><stop offset="0%" stop-color="'.$p.'"/><stop offset="100%" stop-color="'.adj($p,-30).'"/></linearGradient>';
    $o .= '</defs>';
    $o .= '<rect width="400" height="560" fill="'.$bg.'"/>';
    // NAV
    $o .= '<rect width="400" height="38" fill="white"/>';
    $o .= '<rect x="14" y="11" width="4" height="16" rx="2" fill="'.$p.'"/>';
    $o .= '<rect x="20" y="11" width="4" height="16" rx="2" fill="'.$p.'" opacity="0.5"/>';
    $o .= '<text x="30" y="25" font-family="Arial,sans-serif" font-size="13" font-weight="bold" fill="'.$txt.'">MotoStore</text>';
    $o .= '<text x="148" y="24" font-family="Arial,sans-serif" font-size="8" fill="'.$sub.'">Accueil</text>';
    $o .= '<text x="190" y="24" font-family="Arial,sans-serif" font-size="8" fill="'.$sub.'">Catalogue</text>';
    $o .= '<text x="244" y="24" font-family="Arial,sans-serif" font-size="8" fill="'.$sub.'">Marques</text>';
    $o .= '<text x="292" y="24" font-family="Arial,sans-serif" font-size="8" fill="'.$sub.'">Blog</text>';
    $o .= '<rect x="322" y="11" width="60" height="16" rx="8" fill="'.$p.'"/>';
    $o .= '<text x="352" y="23" font-family="Arial,sans-serif" font-size="7" font-weight="bold" fill="white" text-anchor="middle">Acheter</text>';
    // HERO – left gradient, right white
    $o .= '<rect y="38" width="230" height="185" fill="url(#hg'.$vi.')"/>';
    $o .= '<rect x="230" y="38" width="170" height="185" fill="white"/>';
    $o .= '<text x="20" y="78" font-family="Arial,sans-serif" font-size="8" fill="rgba(255,255,255,0.65)" letter-spacing="3">NOUVEAU 2025</text>';
    $o .= '<text x="20" y="106" font-family="Arial,sans-serif" font-size="20" font-weight="bold" fill="white">La Route</text>';
    $o .= '<text x="20" y="128" font-family="Arial,sans-serif" font-size="20" font-weight="bold" fill="white">Vous Attend</text>';
    $o .= '<text x="20" y="150" font-family="Arial,sans-serif" font-size="8" fill="rgba(255,255,255,0.75)">Découvrez notre sélection de motos</text>';
    $o .= '<rect x="20" y="162" width="90" height="24" rx="12" fill="white"/>';
    $o .= '<text x="65" y="178" font-family="Arial,sans-serif" font-size="8" font-weight="bold" fill="'.$p.'" text-anchor="middle">Voir tout</text>';
    $o .= '<rect x="118" y="162" width="90" height="24" rx="12" fill="rgba(255,255,255,0.2)" stroke="white" stroke-width="1"/>';
    $o .= '<text x="163" y="178" font-family="Arial,sans-serif" font-size="8" fill="white" text-anchor="middle">En savoir +</text>';
    // Moto on white panel
    $o .= '<g transform="translate(310, 223) scale(0.88)">'.$moto.'</g>';
    // Floating info card
    $o .= '<rect x="238" y="48" width="150" height="50" rx="8" fill="white" opacity="0.95"/>';
    $o .= '<rect x="248" y="58" width="26" height="26" rx="4" fill="'.$p.'" opacity="0.15"/>';
    $o .= '<text x="282" y="67" font-family="Arial,sans-serif" font-size="8" font-weight="bold" fill="'.$txt.'">+250 modèles</text>';
    $o .= '<text x="282" y="79" font-family="Arial,sans-serif" font-size="7" fill="'.$sub.'">Toutes catégories</text>';
    $o .= '<text x="282" y="91" font-family="Arial,sans-serif" font-size="7" fill="'.$p.'">Voir ›</text>';
    // CATEGORIES strip
    $cats=['Sport','Cruiser','Trail','Scooter'];
    $catClrs=[$p, adj($p,20), adj($p,-20), adj($p,10)];
    for($i=0;$i<4;$i++){
        $cx=$i*100;
        $o .= '<rect x="'.$cx.'" y="223" width="100" height="44" fill="'.$catClrs[$i].'"/>';
        $o .= '<text x="'.($cx+50).'" y="244" font-family="Arial,sans-serif" font-size="9" font-weight="bold" fill="white" text-anchor="middle">'.$cats[$i].'</text>';
        $o .= '<text x="'.($cx+50).'" y="258" font-family="Arial,sans-serif" font-size="7" fill="rgba(255,255,255,0.7)" text-anchor="middle">'.($i*12+20).' modèles</text>';
    }
    // PRODUCTS
    $o .= '<text x="20" y="290" font-family="Arial,sans-serif" font-size="12" font-weight="bold" fill="'.$txt.'">Produits Vedettes</text>';
    $o .= '<rect x="20" y="294" width="50" height="2" rx="1" fill="'.$p.'"/>';
    $names=['Yamaha R6','Honda CB650','Kawasaki Z900']; $prices=['68 500','45 900','56 200'];
    for($i=0;$i<3;$i++){
        $cx=10+$i*130;
        $o .= '<rect x="'.$cx.'" y="300" width="122" height="128" rx="10" fill="'.$card.'"/>';
        $o .= '<rect x="'.$cx.'" y="300" width="122" height="70" rx="10" fill="'.$p.'" opacity="0.1"/>';
        $o .= '<rect x="'.$cx.'" y="356" width="122" height="14" fill="'.$p.'" opacity="0.07"/>';
        $o .= '<g transform="translate('.($cx+60).', 335) scale(0.33)">'.$moto.'</g>';
        $o .= '<text x="'.($cx+61).'" y="384" font-family="Arial,sans-serif" font-size="8" font-weight="bold" fill="'.$txt.'" text-anchor="middle">'.$names[$i].'</text>';
        $o .= '<text x="'.($cx+61).'" y="397" font-family="Arial,sans-serif" font-size="9" font-weight="bold" fill="'.$p.'" text-anchor="middle">'.$prices[$i].' DH</text>';
        $o .= '<rect x="'.($cx+16).'" y="407" width="90" height="15" rx="7.5" fill="'.$p.'"/>';
        $o .= '<text x="'.($cx+61).'" y="419" font-family="Arial,sans-serif" font-size="7" fill="white" text-anchor="middle">Acheter</text>';
    }
    // PROMO
    $o .= '<rect y="442" width="400" height="46" fill="'.$p.'"/>';
    $o .= '<text x="200" y="460" font-family="Arial,sans-serif" font-size="11" font-weight="bold" fill="white" text-anchor="middle">Livraison Express Offerte dès 5000 DH</text>';
    $o .= '<text x="200" y="477" font-family="Arial,sans-serif" font-size="8" fill="rgba(255,255,255,0.8)" text-anchor="middle">Retours gratuits · Paiement en 3x sans frais</text>';
    // FOOTER
    $o .= '<rect y="488" width="400" height="72" fill="'.$txt.'"/>';
    $o .= '<text x="20" y="512" font-family="Arial,sans-serif" font-size="11" font-weight="bold" fill="'.$p.'">MotoStore</text>';
    $o .= '<text x="20" y="528" font-family="Arial,sans-serif" font-size="7" fill="rgba(255,255,255,0.5)">Le spécialiste moto depuis 2005</text>';
    $o .= '<text x="200" y="520" font-family="Arial,sans-serif" font-size="7" fill="rgba(255,255,255,0.5)" text-anchor="middle">'.$nm.'</text>';
    $o .= '</svg>';
    return $o;
}

// ── Layout: VINTAGE ──────────────────────────────────────
function svgVintage(string $p,string $pd,string $pl,string $bg,string $card,string $txt,string $sub,string $moto,int $vi,string $nm): string {
    $o  = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
    $o .= '<svg width="400" height="560" xmlns="http://www.w3.org/2000/svg"><defs>';
    $o .= '<pattern id="dots'.$vi.'" width="12" height="12" patternUnits="userSpaceOnUse"><circle cx="6" cy="6" r="1" fill="'.$p.'" opacity="0.15"/></pattern>';
    $o .= '</defs>';
    $o .= '<rect width="400" height="560" fill="'.$bg.'"/>';
    $o .= '<rect width="400" height="560" fill="url(#dots'.$vi.')"/>';
    $o .= '<rect x="8" y="8" width="384" height="544" rx="4" fill="none" stroke="'.$p.'" stroke-width="2" opacity="0.4"/>';
    $o .= '<rect y="0" width="400" height="48" fill="'.$p.'"/>';
    $o .= '<text x="200" y="22" font-family="Georgia,serif" font-size="14" font-weight="bold" fill="white" text-anchor="middle">MOTO STORE — EST. 1965</text>';
    $o .= '<text x="200" y="38" font-family="Georgia,serif" font-size="8" fill="rgba(255,255,255,0.7)" text-anchor="middle">Vintage &amp; Classic Motorcycles</text>';
    $o .= '<rect y="48" width="400" height="26" fill="'.adj($bg,-5).'"/>';
    foreach(['Accueil','Collection','Restauration','Histoire','Contact'] as $i=>$lbl)
        $o .= '<text x="'.($i*76+18).'" y="65" font-family="Georgia,serif" font-size="8" fill="'.$sub.'">'.$lbl.'</text>';
    // HERO
    $o .= '<rect y="74" width="400" height="170" fill="'.adj($bg,-8).'"/>';
    $o .= '<text x="200" y="110" font-family="Georgia,serif" font-size="8" fill="'.$p.'" text-anchor="middle" letter-spacing="8">COLLECTION CLASSIQUE</text>';
    $o .= '<line x1="60" y1="117" x2="340" y2="117" stroke="'.$p.'" stroke-width="0.8" opacity="0.5"/>';
    $o .= '<text x="200" y="148" font-family="Georgia,serif" font-size="26" font-style="italic" fill="'.$txt.'" text-anchor="middle">Âme Mécanique</text>';
    $o .= '<line x1="60" y1="158" x2="340" y2="158" stroke="'.$p.'" stroke-width="0.8" opacity="0.5"/>';
    $o .= '<text x="200" y="178" font-family="Georgia,serif" font-size="9" fill="'.$sub.'" text-anchor="middle">Motos de collection · Restauration expert · Pièces d\'origine</text>';
    $o .= '<rect x="155" y="190" width="90" height="24" rx="2" fill="'.$p.'"/>';
    $o .= '<text x="200" y="206" font-family="Georgia,serif" font-size="9" font-style="italic" fill="white" text-anchor="middle">Découvrir →</text>';
    $o .= '<g transform="translate(310, 246) scale(1.05)">'.$moto.'</g>';
    // CATALOG
    $o .= '<text x="200" y="264" font-family="Georgia,serif" font-size="13" font-style="italic" fill="'.$txt.'" text-anchor="middle">Notre Sélection</text>';
    $o .= '<line x1="130" y1="270" x2="270" y2="270" stroke="'.$p.'" stroke-width="0.8" opacity="0.6"/>';
    $models=['BSA Gold Star','Triumph Bonneville','Norton Commando']; $years=['1956','1969','1974']; $prices=['120 000','95 000','78 500'];
    for($i=0;$i<3;$i++){
        $cx=16+$i*129;
        $o .= '<rect x="'.$cx.'" y="278" width="120" height="128" rx="4" fill="'.$card.'" stroke="'.$p.'" stroke-width="0.8" opacity="0.6"/>';
        $o .= '<rect x="'.$cx.'" y="278" width="120" height="70" rx="4" fill="'.$p.'" opacity="0.1"/>';
        $o .= '<g transform="translate('.($cx+60).', 313) scale(0.32)">'.$moto.'</g>';
        $o .= '<line x1="'.($cx+10).'" y1="351" x2="'.($cx+110).'" y2="351" stroke="'.$p.'" stroke-width="0.5" opacity="0.4"/>';
        $o .= '<text x="'.($cx+60).'" y="366" font-family="Georgia,serif" font-size="8" font-style="italic" fill="'.$txt.'" text-anchor="middle">'.$models[$i].'</text>';
        $o .= '<text x="'.($cx+60).'" y="378" font-family="Georgia,serif" font-size="7" fill="'.$sub.'" text-anchor="middle">Année '.$years[$i].'</text>';
        $o .= '<text x="'.($cx+60).'" y="393" font-family="Georgia,serif" font-size="9" font-weight="bold" fill="'.$p.'" text-anchor="middle">'.$prices[$i].' DH</text>';
    }
    $o .= '<rect y="418" width="400" height="44" fill="'.$p.'" opacity="0.1"/>';
    $o .= '<text x="200" y="443" font-family="Georgia,serif" font-size="10" font-style="italic" fill="'.$txt.'" text-anchor="middle">"L\'élégance du passé, la puissance du présent"</text>';
    $o .= '<rect y="462" width="400" height="98" fill="'.$p.'"/>';
    $o .= '<text x="200" y="484" font-family="Georgia,serif" font-size="11" font-weight="bold" fill="white" text-anchor="middle">MOTO STORE — CLASSIQUES &amp; VINTAGE</text>';
    $o .= '<text x="200" y="502" font-family="Georgia,serif" font-size="7" fill="rgba(255,255,255,0.65)" text-anchor="middle">Restauration · Expertise · Vente · Pièces d\'origine</text>';
    $o .= '<text x="200" y="526" font-family="Georgia,serif" font-size="7" fill="rgba(255,255,255,0.5)" text-anchor="middle">© 2025 — '.$nm.'</text>';
    $o .= '</svg>';
    return $o;
}

// ── Layout: LUXURY (Gold) ────────────────────────────────
function svgLuxury(string $p,string $pd,string $pl,string $bg,string $card,string $txt,string $sub,string $moto,int $vi,string $nm): string {
    $o  = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
    $o .= '<svg width="400" height="560" xmlns="http://www.w3.org/2000/svg"><defs>';
    $o .= '<linearGradient id="gold'.$vi.'" x1="0%" y1="0%" x2="100%" y2="0%"><stop offset="0%" stop-color="'.$pd.'"/><stop offset="50%" stop-color="'.$pl.'"/><stop offset="100%" stop-color="'.$pd.'"/></linearGradient>';
    $o .= '</defs>';
    $o .= '<rect width="400" height="560" fill="'.$bg.'"/>';
    $o .= '<rect y="0" width="400" height="4" fill="url(#gold'.$vi.')"/>';
    // NAV
    $o .= '<rect y="4" width="400" height="40" fill="'.$card.'"/>';
    $o .= '<text x="20" y="30" font-family="Arial,sans-serif" font-size="14" font-weight="bold" fill="'.$p.'" letter-spacing="3">MOTO</text>';
    $o .= '<text x="62" y="30" font-family="Arial,sans-serif" font-size="14" fill="'.$txt.'" letter-spacing="1">ELITE</text>';
    $o .= '<text x="168" y="28" font-family="Arial,sans-serif" font-size="8" fill="'.$sub.'">Collection</text>';
    $o .= '<text x="225" y="28" font-family="Arial,sans-serif" font-size="8" fill="'.$sub.'">Configurateur</text>';
    $o .= '<text x="310" y="28" font-family="Arial,sans-serif" font-size="8" fill="'.$sub.'">Essai Gratuit</text>';
    // HERO
    $o .= '<rect y="44" width="400" height="200" fill="'.adj($bg, 8).'"/>';
    $o .= '<rect x="0" y="44" width="400" height="3" fill="url(#gold'.$vi.')" opacity="0.6"/>';
    $o .= '<g transform="translate(220, 244) scale(1.15)">'.$moto.'</g>';
    $o .= '<text x="26" y="86" font-family="Arial,sans-serif" font-size="7" fill="'.$p.'" letter-spacing="5">PRESTIGE · 2025</text>';
    $o .= '<text x="26" y="116" font-family="Arial,sans-serif" font-size="24" font-weight="bold" fill="'.$txt.'">ÉLITE</text>';
    $o .= '<text x="26" y="140" font-family="Arial,sans-serif" font-size="24" font-weight="bold" fill="'.$p.'">SERIES</text>';
    $o .= '<text x="26" y="162" font-family="Arial,sans-serif" font-size="8" fill="'.$sub.'">L\'art de la moto premium</text>';
    $o .= '<rect x="26" y="177" width="100" height="24" rx="2" fill="'.$p.'"/>';
    $o .= '<text x="76" y="193" font-family="Arial,sans-serif" font-size="8" font-weight="bold" fill="'.$bg.'" text-anchor="middle">CONFIGURER</text>';
    // Divider
    $o .= '<rect y="244" width="400" height="1" fill="url(#gold'.$vi.')" opacity="0.5"/>';
    $o .= '<text x="20" y="268" font-family="Arial,sans-serif" font-size="13" font-weight="bold" fill="'.$txt.'">Modèles Phares</text>';
    $o .= '<rect x="20" y="271" width="110" height="2" fill="url(#gold'.$vi.')"/>';
    $o .= '<text x="380" y="268" font-family="Arial,sans-serif" font-size="8" fill="'.$p.'" text-anchor="end">Voir tout ›</text>';
    $models=['Road King','Fat Boy','Heritage']; $prices=['195 000','175 000','165 000'];
    for($i=0;$i<3;$i++){
        $cx=12+$i*130;
        $o .= '<rect x="'.$cx.'" y="278" width="122" height="128" rx="4" fill="'.$card.'"/>';
        $o .= '<rect x="'.$cx.'" y="278" width="122" height="4" fill="url(#gold'.$vi.')"/>';
        $o .= '<rect x="'.$cx.'" y="282" width="122" height="66" fill="'.adj($bg,6).'"/>';
        $o .= '<g transform="translate('.($cx+60).', 315) scale(0.33)">'.$moto.'</g>';
        $o .= '<text x="'.($cx+61).'" y="362" font-family="Arial,sans-serif" font-size="8" font-weight="bold" fill="'.$txt.'" text-anchor="middle">'.$models[$i].'</text>';
        $o .= '<text x="'.($cx+61).'" y="374" font-family="Arial,sans-serif" font-size="7" fill="'.$sub.'" text-anchor="middle">Cruiser Premium</text>';
        $o .= '<text x="'.($cx+61).'" y="389" font-family="Arial,sans-serif" font-size="9" font-weight="bold" fill="'.$p.'" text-anchor="middle">'.$prices[$i].' DH</text>';
        $o .= '<rect x="'.($cx+18).'" y="395" width="86" height="2" fill="url(#gold'.$vi.')" opacity="0.5"/>';
    }
    $o .= '<rect y="420" width="400" height="2" fill="url(#gold'.$vi.')"/>';
    $o .= '<rect y="422" width="400" height="138" fill="'.$card.'"/>';
    $o .= '<text x="200" y="450" font-family="Arial,sans-serif" font-size="11" font-weight="bold" fill="'.$p.'" text-anchor="middle" letter-spacing="4">MOTO ELITE</text>';
    $o .= '<text x="200" y="467" font-family="Arial,sans-serif" font-size="8" fill="'.$sub.'" text-anchor="middle">Le luxe en mouvement · '.$nm.'</text>';
    $o .= '<text x="200" y="484" font-family="Arial,sans-serif" font-size="7" fill="rgba(150,150,150,0.5)" text-anchor="middle">© 2025 — Tous droits réservés</text>';
    $o .= '</svg>';
    return $o;
}

// ── Layout: SPORT ENERGY ─────────────────────────────────
function svgEnergy(string $p,string $pd,string $pl,string $bg,string $card,string $txt,string $sub,string $moto,int $vi,string $nm): string {
    $o  = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
    $o .= '<svg width="400" height="560" xmlns="http://www.w3.org/2000/svg"><defs>';
    $o .= '<linearGradient id="eg'.$vi.'" x1="0%" y1="0%" x2="100%" y2="0%"><stop offset="0%" stop-color="'.$p.'"/><stop offset="100%" stop-color="'.$pl.'"/></linearGradient>';
    $o .= '</defs>';
    $o .= '<rect width="400" height="560" fill="'.$bg.'"/>';
    $o .= '<polygon points="0,0 400,0 400,260 260,260" fill="'.$p.'" opacity="0.06"/>';
    // NAV
    $o .= '<rect width="400" height="40" fill="white"/>';
    $o .= '<polygon points="0,0 95,0 82,40 0,40" fill="'.$p.'"/>';
    $o .= '<text x="42" y="25" font-family="Arial,sans-serif" font-size="11" font-weight="bold" fill="white" text-anchor="middle">MOTO</text>';
    $o .= '<text x="110" y="26" font-family="Arial,sans-serif" font-size="9" fill="'.$sub.'">Enduro</text>';
    $o .= '<text x="160" y="26" font-family="Arial,sans-serif" font-size="9" fill="'.$sub.'">Motocross</text>';
    $o .= '<text x="228" y="26" font-family="Arial,sans-serif" font-size="9" fill="'.$sub.'">Equipement</text>';
    $o .= '<rect x="312" y="10" width="75" height="20" rx="3" fill="url(#eg'.$vi.')"/>';
    $o .= '<text x="349" y="24" font-family="Arial,sans-serif" font-size="8" font-weight="bold" fill="white" text-anchor="middle">PROMO -20%</text>';
    // HERO
    $o .= '<rect y="40" width="400" height="188" fill="white"/>';
    $o .= '<polygon points="0,40 400,40 400,175 0,228" fill="'.$p.'" opacity="0.07"/>';
    $o .= '<text x="20" y="76" font-family="Arial,sans-serif" font-size="8" fill="'.$p.'" letter-spacing="4">BORN TO RACE</text>';
    $o .= '<text x="20" y="106" font-family="Arial,sans-serif" font-size="24" font-weight="bold" fill="'.$txt.'">HORS-ROUTE</text>';
    $o .= '<text x="20" y="130" font-family="Arial,sans-serif" font-size="24" font-weight="bold" fill="'.$p.'">PASSION</text>';
    $o .= '<text x="20" y="152" font-family="Arial,sans-serif" font-size="9" fill="'.$sub.'">Motos enduro · Motocross · Trail</text>';
    $o .= '<rect x="20" y="165" width="110" height="28" rx="4" fill="url(#eg'.$vi.')"/>';
    $o .= '<text x="75" y="183" font-family="Arial,sans-serif" font-size="9" font-weight="bold" fill="white" text-anchor="middle">Shop Maintenant ›</text>';
    // Promo tag
    $o .= '<rect x="225" y="55" width="68" height="32" rx="4" fill="'.$p.'"/>';
    $o .= '<text x="259" y="68" font-family="Arial,sans-serif" font-size="8" font-weight="bold" fill="white" text-anchor="middle">NOUVEAU</text>';
    $o .= '<text x="259" y="81" font-family="Arial,sans-serif" font-size="10" font-weight="bold" fill="white" text-anchor="middle">-20%</text>';
    $o .= '<g transform="translate(305,228) scale(1.0)">'.$moto.'</g>';
    // PRODUCTS
    $o .= '<text x="20" y="256" font-family="Arial,sans-serif" font-size="12" font-weight="bold" fill="'.$txt.'">Meilleures Ventes</text>';
    $o .= '<rect x="20" y="260" width="70" height="3" rx="1.5" fill="url(#eg'.$vi.')"/>';
    $models=['KTM 250 EXC','Husqvarna FE','Beta RR 300']; $prices=['62 000','58 500','55 900'];
    for($i=0;$i<3;$i++){
        $cx=10+$i*130;
        $o .= '<rect x="'.$cx.'" y="268" width="122" height="130" rx="6" fill="'.$card.'"/>';
        $o .= '<rect x="'.$cx.'" y="268" width="122" height="70" rx="6" fill="'.$p.'" opacity="0.12"/>';
        $o .= '<rect x="'.($cx+88).'" y="276" width="28" height="14" rx="3" fill="'.$p.'"/>';
        $o .= '<text x="'.($cx+102).'" y="287" font-family="Arial,sans-serif" font-size="6" font-weight="bold" fill="white" text-anchor="middle">PROMO</text>';
        $o .= '<g transform="translate('.($cx+60).', 303) scale(0.33)">'.$moto.'</g>';
        $o .= '<text x="'.($cx+61).'" y="352" font-family="Arial,sans-serif" font-size="8" font-weight="bold" fill="'.$txt.'" text-anchor="middle">'.$models[$i].'</text>';
        $o .= '<text x="'.($cx+61).'" y="366" font-family="Arial,sans-serif" font-size="9" font-weight="bold" fill="'.$p.'" text-anchor="middle">'.$prices[$i].' DH</text>';
        $o .= '<rect x="'.($cx+16).'" y="374" width="90" height="16" rx="4" fill="url(#eg'.$vi.')"/>';
        $o .= '<text x="'.($cx+61).'" y="386" font-family="Arial,sans-serif" font-size="7" font-weight="bold" fill="white" text-anchor="middle">ACHETER ›</text>';
    }
    // BRANDS STRIP
    $o .= '<rect y="412" width="400" height="32" fill="'.$p.'" opacity="0.08"/>';
    $o .= '<text x="200" y="424" font-family="Arial,sans-serif" font-size="7" fill="'.$sub.'" text-anchor="middle" letter-spacing="3">NOS MARQUES PARTENAIRES</text>';
    foreach(['KTM','Husqvarna','Beta','Sherco','Gas Gas'] as $i=>$b)
        $o .= '<text x="'.($i*76+38).'" y="438" font-family="Arial,sans-serif" font-size="8" font-weight="bold" fill="'.$p.'" text-anchor="middle">'.$b.'</text>';
    // FOOTER
    $o .= '<rect y="444" width="400" height="116" fill="'.$txt.'"/>';
    $o .= '<rect y="444" width="400" height="4" fill="url(#eg'.$vi.')"/>';
    $o .= '<text x="20" y="472" font-family="Arial,sans-serif" font-size="12" font-weight="bold" fill="'.$p.'">MOTO SPORT</text>';
    $o .= '<text x="20" y="488" font-family="Arial,sans-serif" font-size="7" fill="rgba(255,255,255,0.5)">Votre partenaire hors-route · '.$nm.'</text>';
    $o .= '</svg>';
    return $o;
}

// ── Layout: ECO / TRAIL ──────────────────────────────────
function svgEco(string $p,string $pd,string $pl,string $bg,string $card,string $txt,string $sub,string $moto,int $vi,string $nm): string {
    $o  = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
    $o .= '<svg width="400" height="560" xmlns="http://www.w3.org/2000/svg"><defs>';
    $o .= '<linearGradient id="sky'.$vi.'" x1="0%" y1="0%" x2="0%" y2="100%"><stop offset="0%" stop-color="'.adj($p,-20).'"/><stop offset="100%" stop-color="'.adj($bg,-10).'"/></linearGradient>';
    $o .= '</defs>';
    $o .= '<rect width="400" height="560" fill="'.$bg.'"/>';
    // Nature scene
    $o .= '<rect y="0" width="400" height="205" fill="url(#sky'.$vi.')"/>';
    $o .= '<polygon points="0,205 80,120 160,205" fill="'.adj($p,-40).'" opacity="0.6"/>';
    $o .= '<polygon points="80,205 200,95 310,205" fill="'.adj($p,-30).'" opacity="0.5"/>';
    $o .= '<polygon points="210,205 320,100 400,205" fill="'.adj($p,-20).'" opacity="0.5"/>';
    $o .= '<rect y="193" width="400" height="14" fill="'.$p.'" opacity="0.45"/>';
    // NAV
    $o .= '<rect width="400" height="38" fill="rgba(0,0,0,0.45)"/>';
    $o .= '<text x="18" y="24" font-family="Arial,sans-serif" font-size="13" font-weight="bold" fill="white">TRAIL<tspan fill="'.$pl.'">MOTO</tspan></text>';
    $o .= '<text x="162" y="24" font-family="Arial,sans-serif" font-size="8" fill="rgba(255,255,255,0.75)">Aventure</text>';
    $o .= '<text x="212" y="24" font-family="Arial,sans-serif" font-size="8" fill="rgba(255,255,255,0.75)">Équipement</text>';
    $o .= '<text x="290" y="24" font-family="Arial,sans-serif" font-size="8" fill="rgba(255,255,255,0.75)">Blog Trail</text>';
    $o .= '<rect x="344" y="11" width="44" height="16" rx="8" fill="'.$p.'"/>';
    $o .= '<text x="366" y="23" font-family="Arial,sans-serif" font-size="7" fill="white" text-anchor="middle">Explorer</text>';
    // HERO TEXT
    $o .= '<text x="20" y="72" font-family="Arial,sans-serif" font-size="8" fill="rgba(255,255,255,0.7)" letter-spacing="3">LIBERTÉ · NATURE · AVENTURE</text>';
    $o .= '<text x="20" y="100" font-family="Arial,sans-serif" font-size="22" font-weight="bold" fill="white">Sur les</text>';
    $o .= '<text x="20" y="124" font-family="Arial,sans-serif" font-size="22" font-weight="bold" fill="'.$pl.'">Sentiers</text>';
    $o .= '<text x="20" y="146" font-family="Arial,sans-serif" font-size="9" fill="rgba(255,255,255,0.75)">Motos Trail, Enduro, Adventure</text>';
    $o .= '<rect x="20" y="157" width="96" height="24" rx="12" fill="'.$p.'"/>';
    $o .= '<text x="68" y="173" font-family="Arial,sans-serif" font-size="8" font-weight="bold" fill="white" text-anchor="middle">Voir collection</text>';
    $o .= '<g transform="translate(305,207) scale(1.0)">'.$moto.'</g>';
    // FEATURE STRIP
    $o .= '<rect y="207" width="400" height="34" fill="'.$p.'" opacity="0.85"/>';
    foreach(['Livraison 48h'=>'50','Garantie 2 ans'=>'150','SAV Expert'=>'258','Essai Gratuit'=>'360'] as $lbl=>$x)
        $o .= '<text x="'.$x.'" y="228" font-family="Arial,sans-serif" font-size="8" font-weight="bold" fill="white" text-anchor="middle">✓ '.$lbl.'</text>';
    // PRODUCTS
    $o .= '<text x="20" y="262" font-family="Arial,sans-serif" font-size="12" font-weight="bold" fill="'.$txt.'">Nos Trails Phares</text>';
    $o .= '<rect x="20" y="266" width="46" height="2.5" rx="1.25" fill="'.$p.'"/>';
    $models=['Honda CRF 450L','Yamaha Tenere','BMW GS Trail']; $prices=['58 900','72 000','95 000'];
    for($i=0;$i<3;$i++){
        $cx=10+$i*130;
        $o .= '<rect x="'.$cx.'" y="273" width="122" height="128" rx="10" fill="'.$card.'"/>';
        $o .= '<rect x="'.$cx.'" y="273" width="122" height="68" rx="10" fill="'.$p.'" opacity="0.15"/>';
        $o .= '<g transform="translate('.($cx+60).', 307) scale(0.32)">'.$moto.'</g>';
        $o .= '<text x="'.($cx+61).'" y="355" font-family="Arial,sans-serif" font-size="8" font-weight="bold" fill="'.$txt.'" text-anchor="middle">'.$models[$i].'</text>';
        $o .= '<text x="'.($cx+61).'" y="368" font-family="Arial,sans-serif" font-size="9" font-weight="bold" fill="'.$p.'" text-anchor="middle">'.$prices[$i].' DH</text>';
        $o .= '<rect x="'.($cx+16).'" y="378" width="90" height="16" rx="8" fill="'.$p.'"/>';
        $o .= '<text x="'.($cx+61).'" y="390" font-family="Arial,sans-serif" font-size="7" fill="white" text-anchor="middle">Ajouter au panier</text>';
    }
    $o .= '<rect y="414" width="400" height="50" fill="'.$p.'" opacity="0.1"/>';
    $o .= '<text x="200" y="436" font-family="Arial,sans-serif" font-size="12" font-weight="bold" fill="'.$txt.'" text-anchor="middle">Prêt pour l\'Aventure?</text>';
    $o .= '<text x="200" y="453" font-family="Arial,sans-serif" font-size="9" fill="'.$sub.'" text-anchor="middle">Équipez-vous chez TrailMoto</text>';
    $o .= '<rect y="464" width="400" height="96" fill="'.adj($p,-50).'"/>';
    $o .= '<text x="200" y="490" font-family="Arial,sans-serif" font-size="12" font-weight="bold" fill="white" text-anchor="middle">TRAIL MOTO</text>';
    $o .= '<text x="200" y="507" font-family="Arial,sans-serif" font-size="8" fill="rgba(255,255,255,0.6)" text-anchor="middle">Votre partenaire aventure · '.$nm.'</text>';
    $o .= '</svg>';
    return $o;
}

// ── Layout: DESERT ───────────────────────────────────────
function svgDesert(string $p,string $pd,string $pl,string $bg,string $card,string $txt,string $sub,string $moto,int $vi,string $nm): string {
    $o  = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
    $o .= '<svg width="400" height="560" xmlns="http://www.w3.org/2000/svg"><defs>';
    $o .= '<linearGradient id="sky'.$vi.'" x1="0%" y1="0%" x2="0%" y2="100%"><stop offset="0%" stop-color="#ffb347"/><stop offset="100%" stop-color="'.$p.'"/></linearGradient>';
    $o .= '<linearGradient id="dune'.$vi.'" x1="0%" y1="0%" x2="0%" y2="100%"><stop offset="0%" stop-color="#f5e6c0"/><stop offset="100%" stop-color="#e8c97a"/></linearGradient>';
    $o .= '</defs>';
    $o .= '<rect width="400" height="560" fill="'.$bg.'"/>';
    $o .= '<rect y="0" width="400" height="225" fill="url(#sky'.$vi.')"/>';
    $o .= '<circle cx="320" cy="110" r="55" fill="#ffdd57" opacity="0.35"/>';
    $o .= '<circle cx="320" cy="110" r="38" fill="#ffa500" opacity="0.25"/>';
    $o .= '<ellipse cx="80" cy="225" rx="160" ry="40" fill="url(#dune'.$vi.')"/>';
    $o .= '<ellipse cx="330" cy="230" rx="180" ry="50" fill="url(#dune'.$vi.')"/>';
    $o .= '<rect y="218" width="400" height="12" fill="#e8c97a"/>';
    $o .= '<rect y="230" width="400" height="330" fill="'.$bg.'"/>';
    // NAV
    $o .= '<rect width="400" height="38" fill="rgba(60,20,0,0.7)"/>';
    $o .= '<text x="18" y="24" font-family="Arial,sans-serif" font-size="13" font-weight="bold" fill="#ffa500">DESERT</text>';
    $o .= '<text x="78" y="24" font-family="Arial,sans-serif" font-size="13" fill="white">MOTO</text>';
    $o .= '<text x="162" y="24" font-family="Arial,sans-serif" font-size="8" fill="rgba(255,255,255,0.75)">Collection</text>';
    $o .= '<text x="218" y="24" font-family="Arial,sans-serif" font-size="8" fill="rgba(255,255,255,0.75)">Off-Road</text>';
    $o .= '<text x="270" y="24" font-family="Arial,sans-serif" font-size="8" fill="rgba(255,255,255,0.75)">Accessoires</text>';
    $o .= '<rect x="344" y="11" width="44" height="16" rx="8" fill="#ffa500"/>';
    $o .= '<text x="366" y="23" font-family="Arial,sans-serif" font-size="7" fill="white" text-anchor="middle">Explorer</text>';
    // HERO TEXT on sky
    $o .= '<text x="20" y="72" font-family="Arial,sans-serif" font-size="8" fill="rgba(255,255,255,0.8)" letter-spacing="3">AVENTURE DESERT</text>';
    $o .= '<text x="20" y="100" font-family="Arial,sans-serif" font-size="24" font-weight="bold" fill="white">Conquer</text>';
    $o .= '<text x="20" y="126" font-family="Arial,sans-serif" font-size="24" font-weight="bold" fill="#ffdd57">Le Désert</text>';
    $o .= '<text x="20" y="150" font-family="Arial,sans-serif" font-size="9" fill="rgba(255,255,255,0.8)">Motos trail · Robustesse · Performance</text>';
    $o .= '<rect x="20" y="162" width="106" height="26" rx="13" fill="#ffa500"/>';
    $o .= '<text x="73" y="179" font-family="Arial,sans-serif" font-size="9" font-weight="bold" fill="white" text-anchor="middle">Voir la gamme</text>';
    $o .= '<g transform="translate(305,228) scale(1.0)">'.$moto.'</g>';
    // PRODUCTS
    $o .= '<text x="20" y="262" font-family="Arial,sans-serif" font-size="12" font-weight="bold" fill="'.$txt.'">Gamme Désert</text>';
    $o .= '<rect x="20" y="266" width="50" height="2.5" rx="1.25" fill="#ffa500"/>';
    $models=['Dakar Pro 450','Rally 650R','Sahara 800']; $prices=['68 500','82 000','105 000'];
    for($i=0;$i<3;$i++){
        $cx=10+$i*130;
        $o .= '<rect x="'.$cx.'" y="273" width="122" height="130" rx="8" fill="'.$card.'"/>';
        $o .= '<rect x="'.$cx.'" y="273" width="122" height="70" rx="8" fill="#ffa500" opacity="0.15"/>';
        $o .= '<rect x="'.($cx+2).'" y="279" width="40" height="12" rx="6" fill="#ffa500"/>';
        $o .= '<text x="'.($cx+22).'" y="289" font-family="Arial,sans-serif" font-size="6" font-weight="bold" fill="white" text-anchor="middle">OFF-ROAD</text>';
        $o .= '<g transform="translate('.($cx+61).', 308) scale(0.32)">'.$moto.'</g>';
        $o .= '<text x="'.($cx+61).'" y="357" font-family="Arial,sans-serif" font-size="8" font-weight="bold" fill="'.$txt.'" text-anchor="middle">'.$models[$i].'</text>';
        $o .= '<text x="'.($cx+61).'" y="371" font-family="Arial,sans-serif" font-size="9" font-weight="bold" fill="#ffa500" text-anchor="middle">'.$prices[$i].' DH</text>';
        $o .= '<rect x="'.($cx+16).'" y="380" width="90" height="16" rx="8" fill="#ffa500"/>';
        $o .= '<text x="'.($cx+61).'" y="392" font-family="Arial,sans-serif" font-size="7" fill="white" text-anchor="middle">Commander</text>';
    }
    $o .= '<rect y="416" width="400" height="36" fill="#ffa500" opacity="0.15"/>';
    $o .= '<text x="200" y="432" font-family="Arial,sans-serif" font-size="10" font-weight="bold" fill="'.$txt.'" text-anchor="middle">Conçu pour résister aux conditions extrêmes</text>';
    $o .= '<text x="200" y="446" font-family="Arial,sans-serif" font-size="8" fill="'.$sub.'" text-anchor="middle">Moteurs éprouvés · Chassis renforcés · Service expert</text>';
    $o .= '<rect y="452" width="400" height="108" fill="'.adj($txt,20).'"/>';
    $o .= '<rect y="452" width="400" height="3" fill="#ffa500"/>';
    $o .= '<text x="200" y="476" font-family="Arial,sans-serif" font-size="13" font-weight="bold" fill="#ffa500" text-anchor="middle">DESERT MOTO</text>';
    $o .= '<text x="200" y="494" font-family="Arial,sans-serif" font-size="8" fill="rgba(255,255,255,0.5)" text-anchor="middle">'.$nm.' · Le spécialiste tout-terrain</text>';
    $o .= '</svg>';
    return $o;
}

// ── SVG builder ──────────────────────────────────────────
function makeSvg(array $t, int $vi, string $ac): string {
    $p  = '#'.$ac;
    $pd = adj($p,-40);
    $pl = adj($p,50);
    $bg = $t['bg']; $card=$t['card']; $txt=$t['txt']; $sub=$t['sub'];
    $nm = $t['name']; $style=$t['style'];
    $moto = getMoto($style, $p, $pd);
    return match($style) {
        'dark','neon','royal' => svgDark($p,$pd,$pl,$bg,$card,$txt,$sub,$moto,$vi,$nm,$style),
        'clean','ocean'       => svgClean($p,$pd,$pl,$bg,$card,$txt,$sub,$moto,$vi,$nm),
        'vintage'             => svgVintage($p,$pd,$pl,$bg,$card,$txt,$sub,$moto,$vi,$nm),
        'luxury'              => svgLuxury($p,$pd,$pl,$bg,$card,$txt,$sub,$moto,$vi,$nm),
        'energy'              => svgEnergy($p,$pd,$pl,$bg,$card,$txt,$sub,$moto,$vi,$nm),
        'eco'                 => svgEco($p,$pd,$pl,$bg,$card,$txt,$sub,$moto,$vi,$nm),
        'desert'              => svgDesert($p,$pd,$pl,$bg,$card,$txt,$sub,$moto,$vi,$nm),
        default               => svgClean($p,$pd,$pl,$bg,$card,$txt,$sub,$moto,$vi,$nm),
    };
}

// ── MAIN GENERATION LOOP ────────────────────────────────
$suffixes = ['Home','Home-1','Home-2','Home-3','Home-4'];
$total = 0; $errors = 0;

foreach ($THEMES as $themeKey => $cfg) {
    $dir = OUT . '/' . $themeKey;
    if (!is_dir($dir)) {
        if (!mkdir($dir, 0755, true)) {
            echo "ERROR: Cannot create directory $dir\n";
            $errors++;
            continue;
        }
    }
    foreach ($cfg['variants'] as $vi => $ac) {
        $svg  = makeSvg($cfg, $vi, $ac);
        $file = $dir . '/' . $suffixes[$vi] . '.svg';
        if (file_put_contents($file, $svg) === false) {
            echo "ERROR: Cannot write $file\n";
            $errors++;
        } else {
            echo "  ✓ $file\n";
            $total++;
        }
    }
}

echo "\n=== Done: $total SVG files generated, $errors errors ===\n";

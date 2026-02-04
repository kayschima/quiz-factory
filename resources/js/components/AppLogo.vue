<script lang="ts" setup></script>

<template>
    <svg
        height="200"
        viewBox="0 0 200 200"
        width="200"
        xmlns="http://www.w3.org/2000/svg"
    >
        <!-- Kreis-Hintergrund (wie beim klassischen runden Wappen) -->
        <circle
            cx="100"
            cy="100"
            fill="#5D3A1A"
            r="95"
            stroke="white"
            stroke-width="2"
        />

        <!-- Mittlere Sektion mit weißen Begrenzungslinien -->
        <line
            stroke="white"
            stroke-width="3"
            x1="10"
            x2="190"
            y1="70"
            y2="70"
        />
        <line
            stroke="white"
            stroke-width="3"
            x1="10"
            x2="190"
            y1="130"
            y2="130"
        />

        <!-- Text "ST. PAULI" -->
        <text
            fill="white"
            font-family="Arial, sans-serif"
            font-size="24"
            font-weight="bold"
            text-anchor="middle"
            x="100"
            y="98"
        >
            ST. PAULI
        </text>

        <!-- Text "FUSSBALL-QUIZ" -->
        <text
            fill="white"
            font-family="Arial, sans-serif"
            font-size="16"
            font-weight="bold"
            text-anchor="middle"
            x="100"
            y="122"
        >
            FUSSBALL-QUIZ
        </text>
    </svg>
</template>

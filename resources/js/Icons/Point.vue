<template>
    <svg aria-hidden="true" focusable="false" data-prefix="fad" data-icon="map-marker-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
        <g class="fa-group">
            <path fill="currentColor" d="M192 0C86 0 0 86 0 192c0 77.41 27 99 172.27 309.67a24 24 0 0 0 39.46 0C357 291 384 269.41 384 192 384 86 298 0 192 0zm0 288a96 96 0 1 1 96-96 96 96 0 0 1-96 96z" :class="light"></path>
            <path fill="currentColor" d="M192 256a64 64 0 1 1 64-64 64 64 0 0 1-64 64z"></path>
        </g>
    </svg>
</template>

<script>
export default {
    props: {light: null}
}
</script>

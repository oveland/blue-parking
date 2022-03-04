<template>
    <svg aria-hidden="true" focusable="false" data-prefix="fad" data-icon="compact-disc" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" class="animate-spin text-blue-800">
        <g class="fa-group">
            <path fill="currentColor" d="M248,8C111,8,0,119,0,256S111,504,248,504,496,393,496,256,385,8,248,8ZM88,256H56C56,150.1,142.1,64,248,64V96C159.8,96,88,167.8,88,256Zm160,96a96,96,0,1,1,96-96A96,96,0,0,1,248,352Z" :class="light"></path>
            <path fill="currentColor" d="M248,160a96,96,0,1,0,96,96A96,96,0,0,0,248,160Zm0,128a32,32,0,1,1,32-32A32,32,0,0,1,248,288Z"></path>
        </g>
    </svg>
</template>

<script>
export default {
    props: {light: null}
}
</script>

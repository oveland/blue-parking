<template>
    <span :class="textColor" @click="$emit('click', $event)">
        <template v-if="is('delete')">
            <svg aria-hidden="true" focusable="false" data-prefix="fad" data-icon="trash-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" :class="`h-${h} w-${w}`">
                <g>
                    <path fill="currentColor" d="M32 464a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V96H32zm272-288a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0z" :class="textColorLight"></path>
                    <path fill="currentColor" d="M432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16zM128 160a16 16 0 0 0-16 16v224a16 16 0 0 0 32 0V176a16 16 0 0 0-16-16zm96 0a16 16 0 0 0-16 16v224a16 16 0 0 0 32 0V176a16 16 0 0 0-16-16zm96 0a16 16 0 0 0-16 16v224a16 16 0 0 0 32 0V176a16 16 0 0 0-16-16z"></path>
                </g>
            </svg>
        </template>

        <template v-if="is('edit')">
            <svg aria-hidden="true" focusable="false" data-prefix="fad" data-icon="pen-nib" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" :class="`h-${h} w-${w}`">
                <g>
                    <path fill="currentColor" d="M288 96l128 128-42.79 151.4a64 64 0 0 1-41.35 43.31L52 512l-14.69-14.69L187.42 347.2a48.45 48.45 0 1 0-22.62-22.62L14.69 474.69 0 460l93.29-279.86a64 64 0 0 1 43.31-41.35z" :class="textColorLight"></path>
                    <path fill="currentColor" d="M497.94 74.17a48 48 0 0 1 0 67.91l-56.55 56.55-128-128 56.55-56.55a48 48 0 0 1 67.91 0z"></path>
                </g>
            </svg>
        </template>

        <template v-if="is('save')">
            <svg aria-hidden="true" focusable="false" data-prefix="fad" data-icon="save" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" :class="`h-${h} w-${w}`">
                <g>
                    <path fill="currentColor" d="M288 352a64 64 0 1 1-64-64 64 64 0 0 1 64 64z" :class="textColorLight"></path>
                    <path fill="currentColor" d="M433.94 129.94l-83.88-83.88A48 48 0 0 0 316.12 32H48A48 48 0 0 0 0 80v352a48 48 0 0 0 48 48h352a48 48 0 0 0 48-48V163.88a48 48 0 0 0-14.06-33.94zM224 416a64 64 0 1 1 64-64 64 64 0 0 1-64 64zm96-204a12 12 0 0 1-12 12H76a12 12 0 0 1-12-12V108a12 12 0 0 1 12-12h228.52a12 12 0 0 1 8.48 3.52l3.48 3.48a12 12 0 0 1 3.52 8.48z"></path>
                </g>
            </svg>
        </template>

        <template v-if="is('cancel')">
            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="undo-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" :class="`h-${h} w-${w}`">
                <path fill="currentColor" d="M255.545 8c-66.269.119-126.438 26.233-170.86 68.685L48.971 40.971C33.851 25.851 8 36.559 8 57.941V192c0 13.255 10.745 24 24 24h134.059c21.382 0 32.09-25.851 16.971-40.971l-41.75-41.75c30.864-28.899 70.801-44.907 113.23-45.273 92.398-.798 170.283 73.977 169.484 169.442C423.236 348.009 349.816 424 256 424c-41.127 0-79.997-14.678-110.63-41.556-4.743-4.161-11.906-3.908-16.368.553L89.34 422.659c-4.872 4.872-4.631 12.815.482 17.433C133.798 479.813 192.074 504 256 504c136.966 0 247.999-111.033 248-247.998C504.001 119.193 392.354 7.755 255.545 8z"></path>
            </svg>
        </template>

        <template v-if="is('date')">
            <svg aria-hidden="true" focusable="false" data-prefix="fad" data-icon="calendar-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" :class="`h-${h} w-${w}`">
                <g>
                    <path fill="currentColor" d="M0 192v272a48 48 0 0 0 48 48h352a48 48 0 0 0 48-48V192zm128 244a12 12 0 0 1-12 12H76a12 12 0 0 1-12-12v-40a12 12 0 0 1 12-12h40a12 12 0 0 1 12 12zm0-128a12 12 0 0 1-12 12H76a12 12 0 0 1-12-12v-40a12 12 0 0 1 12-12h40a12 12 0 0 1 12 12zm128 128a12 12 0 0 1-12 12h-40a12 12 0 0 1-12-12v-40a12 12 0 0 1 12-12h40a12 12 0 0 1 12 12zm0-128a12 12 0 0 1-12 12h-40a12 12 0 0 1-12-12v-40a12 12 0 0 1 12-12h40a12 12 0 0 1 12 12zm128 128a12 12 0 0 1-12 12h-40a12 12 0 0 1-12-12v-40a12 12 0 0 1 12-12h40a12 12 0 0 1 12 12zm0-128a12 12 0 0 1-12 12h-40a12 12 0 0 1-12-12v-40a12 12 0 0 1 12-12h40a12 12 0 0 1 12 12zm-80-180h32a16 16 0 0 0 16-16V16a16 16 0 0 0-16-16h-32a16 16 0 0 0-16 16v96a16 16 0 0 0 16 16zm-192 0h32a16 16 0 0 0 16-16V16a16 16 0 0 0-16-16h-32a16 16 0 0 0-16 16v96a16 16 0 0 0 16 16z" :class="textColorLight"></path>
                    <path fill="currentColor" d="M448 112v80H0v-80a48 48 0 0 1 48-48h48v48a16 16 0 0 0 16 16h32a16 16 0 0 0 16-16V64h128v48a16 16 0 0 0 16 16h32a16 16 0 0 0 16-16V64h48a48 48 0 0 1 48 48z"></path>
                </g>
            </svg>
        </template>

        <template v-if="is('associated')">
            <svg aria-hidden="true" focusable="false" data-prefix="fad" data-icon="user-tie" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" :class="`h-${h} w-${w}`">
                <g>
                    <path fill="currentColor" d="M191.35 414.77L208 344l-32-56h96l-32 56 16.65 70.77L224 480zM224 256A128 128 0 1 0 96 128a128 128 0 0 0 128 128z" :class="textColorLight"></path>
                    <path fill="currentColor" d="M319.8 288.6L224 480l-95.8-191.4C56.9 292 0 350.3 0 422.4V464a48 48 0 0 0 48 48h352a48 48 0 0 0 48-48v-41.6c0-72.1-56.9-130.4-128.2-133.8z"></path>
                </g>
            </svg>
        </template>

        <template v-if="is('bearing')">
            <svg aria-hidden="true" focusable="false" data-prefix="fad" data-icon="clipboard-list-check" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" :class="`h-${h} w-${w}`">
                <g>
                    <path fill="currentColor" d="M336 64h-80a64 64 0 0 1 64 64H64a64 64 0 0 1 64-64H48a48 48 0 0 0-48 48v352a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V112a48 48 0 0 0-48-48zM65.6 241.4l12.7-12.6a5.37 5.37 0 0 1 7.6 0l20.6 20.8 47.6-47.2a5.37 5.37 0 0 1 7.6 0l12.6 12.7a5.37 5.37 0 0 1 0 7.6l-64.2 63.6a5.37 5.37 0 0 1-7.6 0L65.6 249a5.37 5.37 0 0 1 0-7.6zM96 392a24 24 0 1 1 24-24 23.94 23.94 0 0 1-24 24zm224-16a8 8 0 0 1-8 8H168a8 8 0 0 1-8-8v-16a8 8 0 0 1 8-8h144a8 8 0 0 1 8 8zm0-96c0 4.4-4.3 8-9.6 8H154.1l32.3-32h124c5.3 0 9.6 3.6 9.6 8z" :class="textColorLight"></path>
                    <path fill="currentColor" d="M96 344a24 24 0 1 0 24 24 23.94 23.94 0 0 0-24-24zm65.7-141.6a5.37 5.37 0 0 0-7.6 0l-47.6 47.2-20.6-20.8a5.37 5.37 0 0 0-7.6 0l-12.7 12.6a5.37 5.37 0 0 0 0 7.6l36.9 37.3a5.37 5.37 0 0 0 7.6 0l64.2-63.6a5.37 5.37 0 0 0 0-7.6zM256 64a64 64 0 0 0-128 0 64 64 0 0 0-64 64h256a64 64 0 0 0-64-64zm-64 24a24 24 0 1 1 24-24 23.94 23.94 0 0 1-24 24z"></path>
                </g>
            </svg>
        </template>

        <template v-if="is('city')">
            <svg aria-hidden="true" focusable="false" data-prefix="fad" data-icon="map-marked-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" :class="`h-${h} w-${w}`">
                <g>
                    <path fill="currentColor" d="M554.06 161.16L416 224v288l139.88-55.95A32 32 0 0 0 576 426.34V176a16 16 0 0 0-21.94-14.84zM20.12 216A32 32 0 0 0 0 245.66V496a16 16 0 0 0 21.94 14.86L160 448V214.92a302.84 302.84 0 0 1-21.25-46.42zM288 359.67a47.78 47.78 0 0 1-36.51-17C231.83 319.51 210.92 293.09 192 266v182l192 64V266c-18.92 27.09-39.82 53.52-59.49 76.72A47.8 47.8 0 0 1 288 359.67z" :class="textColorLight"></path>
                    <path fill="currentColor" d="M288 0a126 126 0 0 0-126 126c0 56.26 82.35 158.8 113.9 196a15.77 15.77 0 0 0 24.2 0C331.65 284.8 414 182.26 414 126A126 126 0 0 0 288 0zm0 168a42 42 0 1 1 42-42 42 42 0 0 1-42 42z"></path>
                </g>
            </svg>
        </template>

        <template v-if="is('company')">
            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="hotel" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" :class="`h-${h} w-${w}`">
                <path fill="currentColor" d="M560 64c8.84 0 16-7.16 16-16V16c0-8.84-7.16-16-16-16H16C7.16 0 0 7.16 0 16v32c0 8.84 7.16 16 16 16h15.98v384H16c-8.84 0-16 7.16-16 16v32c0 8.84 7.16 16 16 16h240v-80c0-8.8 7.2-16 16-16h32c8.8 0 16 7.2 16 16v80h240c8.84 0 16-7.16 16-16v-32c0-8.84-7.16-16-16-16h-16V64h16zm-304 44.8c0-6.4 6.4-12.8 12.8-12.8h38.4c6.4 0 12.8 6.4 12.8 12.8v38.4c0 6.4-6.4 12.8-12.8 12.8h-38.4c-6.4 0-12.8-6.4-12.8-12.8v-38.4zm0 96c0-6.4 6.4-12.8 12.8-12.8h38.4c6.4 0 12.8 6.4 12.8 12.8v38.4c0 6.4-6.4 12.8-12.8 12.8h-38.4c-6.4 0-12.8-6.4-12.8-12.8v-38.4zm-128-96c0-6.4 6.4-12.8 12.8-12.8h38.4c6.4 0 12.8 6.4 12.8 12.8v38.4c0 6.4-6.4 12.8-12.8 12.8h-38.4c-6.4 0-12.8-6.4-12.8-12.8v-38.4zM179.2 256h-38.4c-6.4 0-12.8-6.4-12.8-12.8v-38.4c0-6.4 6.4-12.8 12.8-12.8h38.4c6.4 0 12.8 6.4 12.8 12.8v38.4c0 6.4-6.4 12.8-12.8 12.8zM192 384c0-53.02 42.98-96 96-96s96 42.98 96 96H192zm256-140.8c0 6.4-6.4 12.8-12.8 12.8h-38.4c-6.4 0-12.8-6.4-12.8-12.8v-38.4c0-6.4 6.4-12.8 12.8-12.8h38.4c6.4 0 12.8 6.4 12.8 12.8v38.4zm0-96c0 6.4-6.4 12.8-12.8 12.8h-38.4c-6.4 0-12.8-6.4-12.8-12.8v-38.4c0-6.4 6.4-12.8 12.8-12.8h38.4c6.4 0 12.8 6.4 12.8 12.8v38.4z" class=""></path>
            </svg>
        </template>

        <template v-if="is('office')">
            <svg aria-hidden="true" focusable="false" data-prefix="fad" data-icon="map-marker-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" :class="`h-${h} w-${w}`">
                <g>
                    <path fill="currentColor" d="M192 0C86 0 0 86 0 192c0 77.41 27 99 172.27 309.67a24 24 0 0 0 39.46 0C357 291 384 269.41 384 192 384 86 298 0 192 0zm0 288a96 96 0 1 1 96-96 96 96 0 0 1-96 96z" :class="textColorLight"></path>
                    <path fill="currentColor" d="M192 256a64 64 0 1 1 64-64 64 64 0 0 1-64 64z"></path>
                </g>
            </svg>
        </template>

        <template v-if="is('ticket-office')">
            <svg aria-hidden="true" focusable="false" data-prefix="fad" data-icon="bookmark" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" :class="`h-${h} w-${w}`">
                <g>
                    <path fill="currentColor" d="M384 48v464L192 400 0 512V48A48 48 0 0 1 48 0h32v326.11a16 16 0 0 0 23.16 14.31L192 296l88.84 44.42A16 16 0 0 0 304 326.11V0h32a48 48 0 0 1 48 48z" :class="textColorLight"></path>
                    <path fill="currentColor" d="M304 0v326.11a16 16 0 0 1-23.16 14.31L192 296l-88.84 44.42A16 16 0 0 1 80 326.11V0z"></path>
                </g>
            </svg>
        </template>

        <template v-if="is('ticket')">
            <svg aria-hidden="true" style="transform: rotate(-45deg);" focusable="false" data-prefix="fad" data-icon="ticket" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" :class="`h-${h} w-${w}`">
                <g>
                    <path fill="currentColor" d="M576 208v-96a48 48 0 0 0-48-48H48a48 48 0 0 0-48 48v96a48 48 0 0 1 0 96v96a48 48 0 0 0 48 48h480a48 48 0 0 0 48-48v-96a48 48 0 0 1 0-96zM400 400a16 16 0 1 1 16-16 16 16 0 0 1-16 16zm0-64a16 16 0 1 1 16-16 16 16 0 0 1-16 16zm0-64a16 16 0 1 1 16-16 16 16 0 0 1-16 16zm0-64a16 16 0 1 1 16-16 16 16 0 0 1-16 16zm0-64a16 16 0 1 1 16-16 16 16 0 0 1-16 16z" :class="textColorLight"></path>
                    <path fill="currentColor" d="M400 304a16 16 0 1 0 16 16 16 16 0 0 0-16-16zm0 64a16 16 0 1 0 16 16 16 16 0 0 0-16-16zm0-224a16 16 0 1 0-16-16 16 16 0 0 0 16 16zm0 96a16 16 0 1 0 16 16 16 16 0 0 0-16-16zm0-64a16 16 0 1 0 16 16 16 16 0 0 0-16-16z"></path>
                </g>
            </svg>
        </template>

        <template v-if="is('vehicle')">
            <svg aria-hidden="true" focusable="false" data-prefix="fad" data-icon="car-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 480 512" :class="`h-${h} w-${w}`">
                <g class="fa-group">
                    <path fill="currentColor" d="M176.5,128h127a48,48,0,0,1,44.57,30.17L368,208H112l19.93-49.83A48,48,0,0,1,176.5,128ZM416,384H368v32a32,32,0,0,0,32,32h32a32,32,0,0,0,32-32V368a31.28,31.28,0,0,0-.43-5.2A63.81,63.81,0,0,1,416,384ZM64,384a63.81,63.81,0,0,1-47.57-21.2A31.28,31.28,0,0,0,16,368v48a32,32,0,0,0,32,32H80a32,32,0,0,0,32-32V384Z" :class="textColorLight"></path>
                    <path fill="currentColor" d="M438.66,212.33,407.49,134.4A111.47,111.47,0,0,0,303.5,64h-127a111.47,111.47,0,0,0-104,70.4L41.34,212.33A63.88,63.88,0,0,0,0,272v48a64,64,0,0,0,64,64H416a64,64,0,0,0,64-64V272A63.88,63.88,0,0,0,438.66,212.33ZM131.93,158.17A48,48,0,0,1,176.5,128h127a48,48,0,0,1,44.57,30.17L368,208H112ZM80,319.8c-19.2,0-32-12.76-32-31.9S60.8,256,80,256s48,28.71,48,47.85S99.2,319.8,80,319.8Zm320,0c-19.2,0-48,3.19-48-15.95S380.8,256,400,256s32,12.76,32,31.9S419.2,319.8,400,319.8Z" class="fa-primary"></path>
                </g>
            </svg>
        </template>

        <template v-if="is('route')">
            <svg aria-hidden="true" focusable="false" data-prefix="fad" data-icon="route" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" :class="`h-${h} w-${w}`">
                <g>
                    <path fill="currentColor" d="M512 416a96.15 96.15 0 0 1-96 96H138.2a690.4 690.4 0 0 0 47.3-64H416a32 32 0 0 0 0-64h-96a96 96 0 0 1 0-192h45.24A799.82 799.82 0 0 0 416 256h-96a32 32 0 0 0 0 64h96a96.15 96.15 0 0 1 96 96z" :class="textColorLight"></path>
                    <path fill="currentColor" d="M96 256a96 96 0 0 0-96 96c0 53 96 160 96 160s96-107 96-160a96 96 0 0 0-96-96zm0 128a32 32 0 1 1 32-32 32 32 0 0 1-32 32zM416 0a96 96 0 0 0-96 96c0 53 96 160 96 160s96-107 96-160a96 96 0 0 0-96-96zm0 128a32 32 0 1 1 32-32 32 32 0 0 1-32 32z"></path>
                </g>
            </svg>
        </template>

        <template v-if="is('service-type')">
            <svg aria-hidden="true" focusable="false" data-prefix="fad" data-icon="location-arrow" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" :class="`h-${h} w-${w}`">
                <g>
                    <path fill="currentColor" d="M461.91 0a45 45 0 0 0-17.4 3.52L28.73 195.42c-48 22.39-32 92.75 19.19 92.75h175.91v175.91c0 30 24.21 47.94 48.74 47.94 17.3 0 34.76-8.91 44-28.75L508.48 67.49C522.06 34.89 494.14 0 461.91 0zM303.83 320V208.17H192l207.67-95.85z" :class="textColorLight"></path>
                    <path fill="currentColor" d="M399.68 112.32L303.83 320V208.17H192l207.67-95.85"></path>
                </g>
            </svg>
        </template>

        <template v-if="is('turn')">
            <svg aria-hidden="true" focusable="false" data-prefix="fad" data-icon="user-clock" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" :class="`h-${h} w-${w}`">
                <g>
                    <path fill="currentColor" d="M496 224a144 144 0 1 0 144 144 143.91 143.91 0 0 0-144-144zm64 150.3a9.77 9.77 0 0 1-9.7 9.7h-60.6a9.77 9.77 0 0 1-9.7-9.7v-76.6a9.77 9.77 0 0 1 9.7-9.7h12.6a9.77 9.77 0 0 1 9.7 9.7V352h38.3a9.77 9.77 0 0 1 9.7 9.7z" :class="textColorLight"></path>
                    <path fill="currentColor" d="M224 256A128 128 0 1 0 96 128a128 128 0 0 0 128 128zm96 112a175.38 175.38 0 0 1 18.2-77.5 133.25 133.25 0 0 0-24.6-2.5h-16.7a174.08 174.08 0 0 1-145.8 0h-16.7A134.43 134.43 0 0 0 0 422.4V464a48 48 0 0 0 48 48h347.1c-45.3-31.9-75.1-84.5-75.1-144z"></path>
                </g>
            </svg>
        </template>

        <template v-if="is('passengers')">
            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="users-class" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" :class="`h-${h} w-${w}`">
                <path fill="currentColor" d="M256 288c0 35.35 28.66 64 64 64 35.35 0 64-28.65 64-64s-28.65-64-64-64c-35.34 0-64 28.65-64 64zm224 0c0 35.35 28.66 64 64 64 35.35 0 64-28.65 64-64s-28.65-64-64-64c-35.34 0-64 28.65-64 64zM96 352c35.35 0 64-28.65 64-64s-28.65-64-64-64c-35.34 0-64 28.65-64 64s28.66 64 64 64zm480 32h-64c-35.34 0-64 28.65-64 64v32c0 17.67 14.33 32 32 32h128c17.67 0 32-14.33 32-32v-32c0-35.35-28.66-64-64-64zm-224 0h-64c-35.34 0-64 28.65-64 64v32c0 17.67 14.33 32 32 32h128c17.67 0 32-14.33 32-32v-32c0-35.35-28.66-64-64-64zm-224 0H64c-35.34 0-64 28.65-64 64v32c0 17.67 14.33 32 32 32h128c17.67 0 32-14.33 32-32v-32c0-35.35-28.66-64-64-64zM96 64h448v128c24.68 0 46.98 9.62 64 24.97V49.59C608 22.25 586.47 0 560 0H80C53.53 0 32 22.25 32 49.59v167.38C49.02 201.62 71.33 192 96 192V64z" class=""></path>
            </svg>
        </template>

        <template v-if="is('driver')">
            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="user-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" :class="`h-${h} w-${w}`">
                <path fill="currentColor" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 96c48.6 0 88 39.4 88 88s-39.4 88-88 88-88-39.4-88-88 39.4-88 88-88zm0 344c-58.7 0-111.3-26.6-146.5-68.2 18.8-35.4 55.6-59.8 98.5-59.8 2.4 0 4.8.4 7.1 1.1 13 4.2 26.6 6.9 40.9 6.9 14.3 0 28-2.7 40.9-6.9 2.3-.7 4.7-1.1 7.1-1.1 42.9 0 79.7 24.4 98.5 59.8C359.3 421.4 306.7 448 248 448z" class=""></path>
            </svg>
        </template>

        <template v-if="is('dispatch') || is('rocket-launch')">
            <svg aria-hidden="true" focusable="false" data-prefix="fad" data-icon="rocket-launch" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" :class="`h-${h} w-${w}`">
                <g>
                    <path fill="currentColor" d="M35.67945,352.06641C9.82789,377.91992-2.94945,442.59375.57789,511.41016c69.10156,3.55859,133.58984-9.35157,159.33984-35.10547,40.28516-40.2793,42.8711-93.98633,6.3086-130.54883C129.66773,309.19727,75.9607,311.78516,35.67945,352.06641Zm94.957,81.05468c-10.73046,10.73243-37.60546,16.11133-66.40234,14.627-1.46484-28.67383,3.85938-55.623,14.63281-66.39649,16.78125-16.78515,39.16407-17.86328,54.39844-2.6289C148.49586,393.959,147.42164,416.33789,130.63648,433.12109ZM51.94117,154.48438,2.531,253.29688A28.125,28.125,0,0,0-.00023,264a24.00619,24.00619,0,0,0,24,24H117.4607c23.44141-47.41211,61.01172-123.373,77.89063-157.32812.51953-.91407,1-1.76758,1.52344-2.67188H94.82008C78.47633,128.01562,59.28883,139.875,51.94117,154.48438ZM381.3357,316.57227c-33.96093,17.00781-110.0625,54.67968-157.33593,78.07421V488.209A24.12394,24.12394,0,0,0,247.9607,512a28.02965,28.02965,0,0,0,10.625-2.53125l98.72657-49.39063c14.625-7.3125,26.5-26.5,26.5-42.85937V315.70312c.0664-.041.125-.08789.1875-.1289v-.52734C383.09352,315.56641,382.25367,316.04883,381.3357,316.57227Z" :class="textColorLight"></path>
                    <path fill="currentColor" d="M505.15992,19.51562A16.73971,16.73971,0,0,0,492.62477,6.94531C460.22633,0,434.37477,0,409.48414,0,320.3357,0,252.80836,40.61523,196.97633,127.81836c-.5586.97852-1.07031,1.877-1.625,2.85352C178.47242,164.627,140.90211,240.58789,117.4607,288h10.53907a95.99975,95.99975,0,0,1,96,96v10.64648c47.27343-23.39453,123.375-61.0664,157.33593-78.07421.96094-.54883,1.832-1.04883,2.78907-1.59766,87.23437-56.06055,127.85937-123.51172,127.85937-212.27734C512.06227,77.60742,512.12867,52.08789,505.15992,19.51562ZM367.99977,192a48,48,0,1,1,48-48.00195A48.02156,48.02156,0,0,1,367.99977,192ZM78.867,381.35156C68.09352,392.125,62.7693,419.07422,64.23414,447.74805c28.79688,1.48437,55.67188-3.89453,66.40234-14.627,16.78516-16.7832,17.85938-39.16211,2.62891-54.39843C118.031,363.48828,95.6482,364.56641,78.867,381.35156Z"></path>
                </g>
            </svg>
        </template>

        <template v-if="is('rocket')">
            <svg aria-hidden="true" focusable="false" data-prefix="fad" data-icon="rocket" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" :class="`h-${h} w-${w}`">
                <g>
                    <path fill="currentColor" d="M51.94117,154.48438,2.531,253.29688A28.125,28.125,0,0,0-.00023,264a24.00619,24.00619,0,0,0,24,24H117.4607c23.44141-47.41211,61.01172-123.373,77.89063-157.32812.51953-.91407,1-1.76758,1.52344-2.67188H94.82008C78.47633,128.01562,59.28883,139.875,51.94117,154.48438Zm172.0586,240.1621V488.209A24.12394,24.12394,0,0,0,247.9607,512a28.02965,28.02965,0,0,0,10.625-2.53125l98.72657-49.39063c14.625-7.3125,26.5-26.5,26.5-42.85937V315.70312c.0664-.041.125-.08789.1875-.1289v-.52734c-.90625.51953-1.7461,1.002-2.66407,1.52539C347.37477,333.58008,271.2732,371.252,223.99977,394.64648Z" :class="textColorLight"></path>
                    <path fill="currentColor" d="M505.15992,19.51562A16.73971,16.73971,0,0,0,492.62477,6.94531C460.22633,0,434.37477,0,409.48414,0,320.3357,0,252.80836,40.61523,196.97633,127.81836c-.5586.97852-1.07031,1.877-1.625,2.85352-19.59766,39.42578-67.20313,135.70312-88.04688,177.877a31.91421,31.91421,0,0,0,6.09766,36.76172L167.05445,398.709a31.88923,31.88923,0,0,0,36.64844,5.98047l14.17578-7.01367c46.57422-23.04883,128.06641-63.3789,163.457-81.10351.96094-.54883,1.832-1.04883,2.78907-1.59766,87.23437-56.06055,127.85937-123.51172,127.85937-212.27734C512.06227,77.60742,512.12867,52.08789,505.15992,19.51562ZM367.99977,192a48,48,0,1,1,48-48.00195A48.02156,48.02156,0,0,1,367.99977,192Z"></path>
                </g>
            </svg>
        </template>

        <template v-if="is('clock')">
            <svg aria-hidden="true" focusable="false" data-prefix="fad" data-icon="clock" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" :class="`h-${h} w-${w}`">
                <g>
                    <path fill="currentColor" d="M256,8C119,8,8,119,8,256S119,504,256,504,504,393,504,256,393,8,256,8Zm92.49,313h0l-20,25a16,16,0,0,1-22.49,2.5h0l-67-49.72a40,40,0,0,1-15-31.23V112a16,16,0,0,1,16-16h32a16,16,0,0,1,16,16V256l58,42.5A16,16,0,0,1,348.49,321Z" :class="textColorLight"></path>
                    <path fill="currentColor" d="M348.49,321h0l-20,25a16,16,0,0,1-22.49,2.5h0l-67-49.72a40,40,0,0,1-15-31.23V112a16,16,0,0,1,16-16h32a16,16,0,0,1,16,16V256l58,42.5A16,16,0,0,1,348.49,321Z"></path>
                </g>
            </svg>
        </template>

        <template v-if="is('user')">
            <svg aria-hidden="true" focusable="false" data-prefix="fad" data-icon="user-headset" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" :class="`h-${h} w-${w}`">
                <g>
                    <path fill="currentColor" d="M416 192v16a112.15 112.15 0 0 1-112 112h-96a32 32 0 0 1 0-64h32a32 32 0 0 1 32 32h32a80.09 80.09 0 0 0 80-80v-16c0-88.22-71.78-160-160-160S64 103.78 64 192v16a16 16 0 0 1-32 0v-16C32 86.13 118.13 0 224 0s192 86.13 192 192z" :class="textColorLight"></path>
                    <path fill="currentColor" d="M320 352h-23.1a174.1 174.1 0 0 1-145.8 0H128A128 128 0 0 0 0 480a32 32 0 0 0 32 32h384a32 32 0 0 0 32-32 128 128 0 0 0-128-128zm-175.65-60.53c-.06-1.17-.35-2.28-.35-3.47a64.07 64.07 0 0 1 64-64h32a64 64 0 0 1 55.41 32H304a48.05 48.05 0 0 0 48-48v-16a128 128 0 0 0-256 0c0 40.42 19.1 76 48.35 99.47z"></path>
                </g>
            </svg>
        </template>

        <template v-if="is('print')">
            <svg aria-hidden="true" focusable="false" data-prefix="fad" data-icon="print" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" :class="`h-${h} w-${w}`">
                <g>
                    <path fill="currentColor" d="M64 480a32 32 0 0 0 32 32h320a32 32 0 0 0 32-32v-96H64zM368 96a16 16 0 0 1-16-16V0H96a32 32 0 0 0-32 32v192h384V96z" :class="textColorLight"></path>
                    <path fill="currentColor" d="M368 96h80v-4.58a17.92 17.92 0 0 0-5.25-12.67l-73.43-73.5A18 18 0 0 0 356.57 0H352v80a16 16 0 0 0 16 16zm80 96v32H64v-32a64 64 0 0 0-64 64v112a16 16 0 0 0 16 16h480a16 16 0 0 0 16-16V256a64 64 0 0 0-64-64zm-16 136a24 24 0 1 1 24-24 24 24 0 0 1-24 24z"></path>
                </g>
            </svg>
        </template>

        <template v-if="is('user-add')">
            <svg aria-hidden="true" focusable="false" data-prefix="fad" data-icon="user-plus" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" :class="`h-${h} w-${w}`">
                <g>
                    <path fill="currentColor" d="M640 224v32a16 16 0 0 1-16 16h-64v64a16 16 0 0 1-16 16h-32a16 16 0 0 1-16-16v-64h-64a16 16 0 0 1-16-16v-32a16 16 0 0 1 16-16h64v-64a16 16 0 0 1 16-16h32a16 16 0 0 1 16 16v64h64a16 16 0 0 1 16 16z" :class="textColorLight"></path>
                    <path fill="currentColor" d="M224 256A128 128 0 1 0 96 128a128 128 0 0 0 128 128zm89.6 32h-16.7a174.08 174.08 0 0 1-145.8 0h-16.7A134.43 134.43 0 0 0 0 422.4V464a48 48 0 0 0 48 48h352a48 48 0 0 0 48-48v-41.6A134.43 134.43 0 0 0 313.6 288z"></path>
                </g>
            </svg>
        </template>

        <template v-if="is('annul')">
            <svg aria-hidden="true" focusable="false" data-prefix="fad" data-icon="backspace" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" :class="`h-${h} w-${w}`">
                <g class="fa-group">
                    <path fill="currentColor" d="M576 64H205.26A64 64 0 0 0 160 82.75L9.38 233.37a32 32 0 0 0 0 45.25L160 429.25A64 64 0 0 0 205.25 448H576a64 64 0 0 0 64-64V128a64 64 0 0 0-64-64zm-84.69 254.06a16 16 0 0 1 0 22.63l-22.62 22.62a16 16 0 0 1-22.63 0L384 301.25l-62.06 62.06a16 16 0 0 1-22.63 0l-22.62-22.62a16 16 0 0 1 0-22.63L338.75 256l-62.06-62.06a16 16 0 0 1 0-22.63l22.62-22.62a16 16 0 0 1 22.63 0L384 210.75l62.06-62.06a16 16 0 0 1 22.63 0l22.62 22.62a16 16 0 0 1 0 22.63L429.25 256z" :class="textColorLight"></path>
                    <path fill="currentColor" d="M491.31 318.06a16 16 0 0 1 0 22.63l-22.62 22.62a16 16 0 0 1-22.63 0L384 301.25l-62.06 62.06a16 16 0 0 1-22.63 0l-22.62-22.62a16 16 0 0 1 0-22.63L338.75 256l-62.06-62.06a16 16 0 0 1 0-22.63l22.62-22.62a16 16 0 0 1 22.63 0L384 210.75l62.06-62.06a16 16 0 0 1 22.63 0l22.62 22.62a16 16 0 0 1 0 22.63L429.25 256z" class="fa-primary"></path>
                </g>
            </svg>
        </template>

        <template v-if="is('times')">
            <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="times" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" :class="`h-${h} w-${w}`">
                <path fill="currentColor" d="M193.94 256L296.5 153.44l21.15-21.15c3.12-3.12 3.12-8.19 0-11.31l-22.63-22.63c-3.12-3.12-8.19-3.12-11.31 0L160 222.06 36.29 98.34c-3.12-3.12-8.19-3.12-11.31 0L2.34 120.97c-3.12 3.12-3.12 8.19 0 11.31L126.06 256 2.34 379.71c-3.12 3.12-3.12 8.19 0 11.31l22.63 22.63c3.12 3.12 8.19 3.12 11.31 0L160 289.94 262.56 392.5l21.15 21.15c3.12 3.12 8.19 3.12 11.31 0l22.63-22.63c3.12-3.12 3.12-8.19 0-11.31L193.94 256z" class=""></path>
            </svg>
        </template>

        <template v-if="is('qr-code')">
            <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="qrcode" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" :class="`h-${h} w-${w}`">
                <path fill="currentColor" d="M0 224h192V32H0v192zM32 64h128v128H32V64zm224-32v192h192V32H256zm160 160H288V64h128v128zM0 480h192V288H0v192zm32-160h128v128H32V320zM64 96h64v64H64V96zm320 64h-64V96h64v64zM64 352h64v64H64v-64zm352-64h32v128H320v-32h-32v96h-32V288h96v32h64v-32zm0 160h32v32h-32v-32zm-64 0h32v32h-32v-32z" class=""></path>
            </svg>
        </template>

        <template v-if="is('liquidation')">
            <svg aria-hidden="true" focusable="false" data-prefix="fad" data-icon="file-invoice-dollar" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" :class="`h-${h} w-${w}`">
                <g class="fa-group">
                    <path fill="currentColor" d="M384 128H272a16 16 0 0 1-16-16V0H24A23.94 23.94 0 0 0 0 23.88V488a23.94 23.94 0 0 0 23.88 24H360a23.94 23.94 0 0 0 24-23.88V128zM64 72a8 8 0 0 1 8-8h80a8 8 0 0 1 8 8v16a8 8 0 0 1-8 8H72a8 8 0 0 1-8-8zm0 80v-16a8 8 0 0 1 8-8h80a8 8 0 0 1 8 8v16a8 8 0 0 1-8 8H72a8 8 0 0 1-8-8zm144 263.88V440a8 8 0 0 1-8 8h-16a8 8 0 0 1-8-8v-24.29a57.32 57.32 0 0 1-31.37-11.35 8 8 0 0 1-.57-12.14L155.81 381a8.22 8.22 0 0 1 10.13-.73 24.06 24.06 0 0 0 12.82 3.73h28.11c6.5 0 11.8-5.92 11.8-13.19 0-5.95-3.61-11.19-8.77-12.73l-45-13.5c-18.59-5.58-31.58-23.42-31.58-43.39 0-24.52 19.05-44.44 42.67-45.07V232a8 8 0 0 1 8-8h16a8 8 0 0 1 8 8v24.29a57.17 57.17 0 0 1 31.37 11.35 8 8 0 0 1 .57 12.14L228.18 291a8.22 8.22 0 0 1-10.13.73 24 24 0 0 0-12.82-3.73h-28.11c-6.5 0-11.8 5.92-11.8 13.19 0 5.95 3.61 11.19 8.77 12.73l45 13.5c18.59 5.58 31.58 23.42 31.58 43.39 0 24.53-19 44.44-42.67 45.07z" :class="textColorLight"></path>
                    <path fill="currentColor" d="M377 105L279.1 7a24 24 0 0 0-17-7H256v112a16 16 0 0 0 16 16h112v-6.1a23.9 23.9 0 0 0-7-16.9zM219.09 327.42l-45-13.5c-5.16-1.54-8.77-6.78-8.77-12.73 0-7.27 5.3-13.19 11.8-13.19h28.11a24 24 0 0 1 12.82 3.73 8.22 8.22 0 0 0 10.13-.73l11.76-11.22a8 8 0 0 0-.57-12.14A57.17 57.17 0 0 0 208 256.29V232a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v24.12c-23.62.63-42.67 20.55-42.67 45.07 0 20 13 37.81 31.58 43.39l45 13.5c5.16 1.54 8.77 6.78 8.77 12.73 0 7.27-5.3 13.19-11.8 13.19h-28.12a24.06 24.06 0 0 1-12.82-3.73 8.22 8.22 0 0 0-10.13.73l-11.75 11.22a8 8 0 0 0 .57 12.14A57.32 57.32 0 0 0 176 415.71V440a8 8 0 0 0 8 8h16a8 8 0 0 0 8-8v-24.12c23.67-.63 42.67-20.54 42.67-45.07 0-19.97-12.99-37.81-31.58-43.39z" class="fa-primary"></path>
                </g>
            </svg>
        </template>

        <template v-if="is('menu')">
            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="bars" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" :class="`h-${h} w-${w}`">
                <path fill="currentColor" d="M16 132h416c8.837 0 16-7.163 16-16V76c0-8.837-7.163-16-16-16H16C7.163 60 0 67.163 0 76v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z" class=""></path>
            </svg>

        </template>

        <template v-if="is('warning')">
            <svg stroke="currentColor" fill="none" viewBox="0 0 24 24" :class="`h-${h} w-${w}`">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
        </template>

        <template v-if="is('search')">
            <svg aria-hidden="true" focusable="false" data-prefix="fad" data-icon="search" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" :class="`h-${h} w-${w}`">
                <g class="fa-group">
                    <path fill="currentColor" d="M208 80a128 128 0 1 1-90.51 37.49A127.15 127.15 0 0 1 208 80m0-80C93.12 0 0 93.12 0 208s93.12 208 208 208 208-93.12 208-208S322.88 0 208 0z" :class="textColorLight"></path>
                    <path fill="currentColor" d="M504.9 476.7L476.6 505a23.9 23.9 0 0 1-33.9 0L343 405.3a24 24 0 0 1-7-17V372l36-36h16.3a24 24 0 0 1 17 7l99.7 99.7a24.11 24.11 0 0 1-.1 34z" class="fa-primary"></path>
                </g>
            </svg>
        </template>

        <template v-if="is('up')">
            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-up" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" :class="`h-${h} w-${w}`">
                <path fill="currentColor" d="M240.971 130.524l194.343 194.343c9.373 9.373 9.373 24.569 0 33.941l-22.667 22.667c-9.357 9.357-24.522 9.375-33.901.04L224 227.495 69.255 381.516c-9.379 9.335-24.544 9.317-33.901-.04l-22.667-22.667c-9.373-9.373-9.373-24.569 0-33.941L207.03 130.525c9.372-9.373 24.568-9.373 33.941-.001z" class=""></path>
            </svg>
        </template>

        <template v-if="is('down')">
            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-down" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" :class="`h-${h} w-${w}`">
                <path fill="currentColor" d="M207.029 381.476L12.686 187.132c-9.373-9.373-9.373-24.569 0-33.941l22.667-22.667c9.357-9.357 24.522-9.375 33.901-.04L224 284.505l154.745-154.021c9.379-9.335 24.544-9.317 33.901.04l22.667 22.667c9.373 9.373 9.373 24.569 0 33.941L240.971 381.476c-9.373 9.372-24.569 9.372-33.942 0z" class=""></path>
            </svg>
        </template>

        <template v-if="is('filter')">
            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="filter" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" :class="`h-${h} w-${w}`">
                <path fill="currentColor" d="M487.976 0H24.028C2.71 0-8.047 25.866 7.058 40.971L192 225.941V432c0 7.831 3.821 15.17 10.237 19.662l80 55.98C298.02 518.69 320 507.493 320 487.98V225.941l184.947-184.97C520.021 25.896 509.338 0 487.976 0z" class=""></path>
            </svg>
        </template>

        <template v-if="is('excel')">
            <svg aria-hidden="true" focusable="false" data-prefix="fad" data-icon="file-excel" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" :class="`h-${h} w-${w}`">
                <g class="fa-group">
                    <path fill="currentColor" d="M384 128H272a16 16 0 0 1-16-16V0H24A23.94 23.94 0 0 0 0 23.88V488a23.94 23.94 0 0 0 23.88 24H360a23.94 23.94 0 0 0 24-23.88V128zM280.51 446.09A12 12 0 0 1 274 448h-34.9a12 12 0 0 1-10.6-6.3C208.9 405.5 192 373 192 373c-6.4 14.8-10 20-36.6 68.8a11.89 11.89 0 0 1-10.5 6.3H110a12 12 0 0 1-10.1-18.5l60.3-93.5-60.3-93.5a12 12 0 0 1 10.1-18.5h34.8a12 12 0 0 1 10.6 6.3c26.1 48.8 20 33.6 36.6 68.5 0 0 6.1-11.7 36.6-68.5a12 12 0 0 1 10.6-6.3H274a11.93 11.93 0 0 1 10.1 18.4L224 336l60.1 93.5a12 12 0 0 1-3.59 16.59z" :class="textColorLight"></path>
                    <path fill="currentColor" d="M377 105L279.1 7a24 24 0 0 0-17-7H256v112a16 16 0 0 0 16 16h112v-6.1a23.9 23.9 0 0 0-7-16.9zM224 336l60.1-93.5a11.93 11.93 0 0 0-10.1-18.4h-34.8a12 12 0 0 0-10.6 6.3c-30.5 56.8-36.6 68.5-36.6 68.5-16.6-34.9-10.5-19.7-36.6-68.5a12 12 0 0 0-10.6-6.3H110a12 12 0 0 0-10.1 18.5l60.3 93.5-60.3 93.5a12 12 0 0 0 10.1 18.5h34.9a11.89 11.89 0 0 0 10.5-6.3c26.6-48.8 30.2-54 36.6-68.8 0 0 16.9 32.5 36.5 68.7a12 12 0 0 0 10.6 6.3H274a12 12 0 0 0 10.1-18.5z"></path>
                </g>
            </svg>
        </template>

        <template v-if="is('dashboard')">
            <svg aria-hidden="true" focusable="false" data-prefix="fad" data-icon="tachometer-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" :class="`h-${h} w-${w}`">
                <g class="fa-group">
                    <path fill="currentColor" d="M288 32C128.94 32 0 160.94 0 320a286.5 286.5 0 0 0 39.06 144.8c5.61 9.62 16.3 15.2 27.44 15.2h443c11.14 0 21.83-5.58 27.44-15.2A286.5 286.5 0 0 0 576 320c0-159.06-128.94-288-288-288zm0 64c14.71 0 26.58 10.13 30.32 23.65-1.11 2.26-2.64 4.23-3.45 6.67L305.65 154c-5.13 3.49-11 6-17.64 6a32 32 0 0 1 0-64zM96 384a32 32 0 1 1 32-32 32 32 0 0 1-32 32zm48-160a32 32 0 1 1 32-32 32 32 0 0 1-32 32zm246.77-72.41l-61.33 184A62.8 62.8 0 0 1 343.12 416H232.88a63.34 63.34 0 0 1 51-95.59l61.34-184a24 24 0 0 1 45.53 15.19zm14.66 57.2L421 162.24a31.54 31.54 0 0 1 11-2.24 32 32 0 0 1 0 64c-11.38 0-20.89-6.27-26.57-15.21zM480 384a32 32 0 1 1 32-32 32 32 0 0 1-32 32z"></path>
                    <path fill="currentColor" d="M283.9 320.41l61.34-184a24 24 0 0 1 45.53 15.19l-61.33 184a62.8 62.8 0 0 1 13.68 80.4H232.88a63.34 63.34 0 0 1 51-95.59z" :class="textColorLight"></path>
                </g>
            </svg>
        </template>
    </span>
</template>

<script>
export default {
    props: {
        name : {
            type: String,
            required: true
        },
        color: {
            type: String,
            default: 'gray'
        },
        density: {
            type: [Number, String],
            default: 600
        },
        h: {
            type: [Number, String],
            default: 6
        },
        w: {
            type: [Number, String],
            default: 6
        },
    },
    components:{

    },
    computed:{
        textColor() {
            if (this.color === 'black') {
                return `text-${this.color}`;
            }
            return `text-${this.color}-${this.density}`;
        },
        textColorLight() {
            if (this.color === 'black' || this.color === 'blank') {
                return `text-gray-500`;
            }
            return `text-${this.color}-${this.density - 200}`;
        }
    },
    methods: {
        is(name) {
            return this.name === name;
        }
    }
}
</script>

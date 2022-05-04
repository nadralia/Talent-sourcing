<template>
    <div class="flex items-center justify-center py-20">
        <div class="space-y-4 flex flex-col items-center">
            <h1 class="text-4xl font-semibold">Thank You!</h1>
            <bhr-icon name="check-circle" class="w-36 h-36 text-green-700" />
            <p>Thank you for completing your profile.</p>
            <p>Exciting job offers will be coming your way pretty soon!</p>
            <bhr-button @click="$router.push({ path: '/' })">Done !</bhr-button>
        </div>
    </div>
</template>

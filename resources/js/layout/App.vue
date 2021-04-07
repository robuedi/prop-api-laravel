<template>
    <div>
        <Navigation />
        <div class="container pt-5">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
import Navigation from './Navigation'

export default {
    components: {
        Navigation
    }
}
</script>

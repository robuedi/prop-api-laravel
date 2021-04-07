<template>
    <div>
        <div class="alert alert-warning alert-dismissible fade show" role="alert" v-for="error in errors">
            {{ error }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="alert alert-success alert-dismissible fade show" role="alert" v-for="success_ in success">
            {{ success_ }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        success: Array,
        errors: Array
    },
}
</script>

<style scoped>

</style>

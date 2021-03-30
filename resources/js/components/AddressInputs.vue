<template>
    <div>
        <h5 class="mb-2">{{ title }}</h5>
        <div class="form-group">
            <label for="countries">Country</label>
            <select class="form-control"  id="countries">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
        </div>
        <div class="form-group">
            <label for="cities">City</label>
            <select class="form-control"  v-model="form.city_id" id="cities">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="address_line" class="form-label">Address Line</label>
            <input type="text" v-model="form.address_line" class="form-control w-50" id="address_line" >
        </div>
        <div class="mb-3">
            <label for="postcode" class="form-label">Postcode</label>
            <input type="text" v-model="form.postcode" class="form-control w-50" id="postcode" >
        </div>
    </div>
</template>

<script>
export default {
    props: [
      'title'
    ],
    data () {
        return {
            form: {
                city_id: '',
                address_line: '',
                postcode: ''
            }
        }
    },
    methods: {
    }
}
</script>





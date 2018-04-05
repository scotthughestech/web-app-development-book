<template>
    <form @submit.prevent="submit">
        <div class="alert alert-success" role="alert" v-if="success">
            Your organization has been successfully added!
        </div>
        <div class="alert alert-danger" role="alert" v-if="Object.keys(errors).length">
            <ul>
                <li v-for="error in errors">
                    {{ error[0] }}
                </li>
            </ul>
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" v-model="form.name" required autofocus>
        </div>
        <div class="form-group">
            <label for="street">Street</label>
            <input type="text" class="form-control" id="street" v-model="form.street">
        </div>
        <div class="form-group">
            <label for="city">City</label>
            <input type="text" class="form-control" id="city" v-model="form.city">
        </div>
        <div class="form-group">
            <label for="state">State/Province</label>
            <input type="text" class="form-control" id="state" v-model="form.state">
        </div>
        <div class="form-group">
            <label for="zip">Zip/Postal Code</label>
            <input type="text" class="form-control" id="zip" v-model="form.zip">
        </div>
        <div class="form-group">
            <label for="country">Country</label>
            <input type="text" class="form-control" id="country" v-model="form.country">
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" class="form-control" id="phone" v-model="form.phone">
        </div>
        <div class="form-group">
            <label for="fax">Fax</label>
            <input type="text" class="form-control" id="fax" v-model="form.fax">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" v-model="form.email">
        </div>
        <div class="form-group">
            <label for="website">Website</label>
            <input type="url" class="form-control" id="website" v-model="form.website">
        </div>
        <div class="form-group">
            <label for="type_id">Type</label>
            <select class="form-control" id="type_id" v-model="form.type_id" required>
                <option value="1">Lead</option>
                <option value="2">Prospect</option>
                <option value="3">Client</option>
            </select>
        </div>
        <div class="form-group">
            <label for="notes">Notes</label>
            <textarea class="form-control" id="notes" rows="5" v-model="form.notes"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</template>

<script>
    export default {
        data() {
            return {
                form: {
                    name: '',
                    street: '',
                    city: '',
                    state: '',
                    zip: '',
                    country: '',
                    phone: '',
                    fax: '',
                    email: '',
                    website: '',
                    type_id: 1,
                    notes: ''
                },
                success: false,
                errors: {}
            }
        },
        methods: {
            submit() {
                axios.post('/organizations', this.form)
                    .then(response => {
                        this.clearForm();
                        this.success = true;
                        this.errors = {};
                        scroll(0,0);
                        document.getElementById('name').focus();
                        setTimeout(() => this.success = false, 3000);
                    })
                    .catch(error => {
                        this.errors = error.response.data.errors;
                        scroll(0,0);
                    });
            },
            clearForm() {
                this.form.name = '';
                this.form.street = '';
                this.form.city = '';
                this.form.state = '';
                this.form.zip = '';
                this.form.country = '';
                this.form.phone = '';
                this.form.fax = '';
                this.form.email = '';
                this.form.website = '';
                this.form.type_id = 1;
                this.form.notes = '';
            }
        }
    }
</script>

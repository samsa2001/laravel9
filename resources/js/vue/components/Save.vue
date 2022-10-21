<template>
    <div>
        <h1 v-if="post">Actualizar post {{ post.id }}</h1>
        <h1 v-else>Nuevo post</h1>
        <form @submit.prevent="submit">
            <div class="grid grid-cols-2 gap-3">           
                <div class="col-span-2">     
            <o-field label="Titulo" :variant="errors.title ? 'danger' : 'primary'" :message="errors.title">
                <o-input v-model="form.title" value=""></o-input>
            </o-field>
        </div>
            <o-field label="Descripción" :variant="errors.description ? 'danger' : 'primary'" :message="errors.description">
                <o-input v-model="form.description" type="textarea" value=""></o-input>
            </o-field>
            <o-field label="Contenido" :variant="errors.content ? 'danger' : 'primary'" :message="errors.content">
                <o-input v-model="form.content" type="textarea" value=""></o-input>
            </o-field>
            <o-field label="Categoría" :variant="errors.category_id ? 'danger' : 'primary'" :message="errors.category_id">
                <o-select v-model="form.category_id" placeholder="Seleccionar categoría">
                    <option v-for="c in categories" v-bind:key="c.id" :value="c.id">{{ c.title }}</option>
                </o-select>
            </o-field>
            <o-field label="Posted" :variant="errors.posted ? 'danger' : 'primary'" :message="errors.posted">
                <o-select v-model="form.posted" placeholder="Seleccionar un estado">
                    <option value="yes">Sí</option>
                    <option value="not">No</option>
                </o-select>
            </o-field>
            <o-button variant="primary" native-type="submit">
                Enviar
            </o-button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            categories: [],
            form: {
                title: "",
                description: "",
                content: "",
                category_id: "",
                posted: "",
            },
            errors: {
                title: "",
                description: "",
                content: "",
                category_id: "",
                posted: "",
            },
            post: "",
            file: null,
            filesDaD: [],
            fileError: "",
        }

    },
    async mounted() {
        if (this.$route.params.url_clean){
            await this.getPost()
            this.initPost()
        }
        this.getCategory()
    },
    methods: {
        clearErrorsForm() {
            this.errors.title = ""
            this.errors.category_id = ""
            this.errors.posted = ""
            this.errors.content = ""
            this.errors.description = ""
        },
        submit() {
            this.clearErrorsForm()

            if ( this.post == "" )
                return this.$axios.post('/api/post', this.form)
                    .then((res) => {
                        this.$oruga.notification.open({
                        message: "Guardado con éxito",
                        position: "top",
                        duration: 4000,
                        closable: true,
                        });
                        this.$router.go(-1)
                    })
                    .catch(error => {
                        if (error.response.data.title)
                            this.errors.title = error.response.data.title[0];
                        if (error.response.data.description)
                            this.errors.description = error.response.data.description[0];
                        if (error.response.data.category_id)
                            this.errors.category_id = error.response.data.category_id[0];
                        if (error.response.data.posted)
                            this.errors.posted = error.response.data.posted[0];
                        if (error.response.data.content)
                            this.errors.content = error.response.data.content[0];
                    })
                return this.$axios.patch('/api/post/' + this.post.id, this.form)
                    .then((res) => {
                        this.$oruga.notification.open({
                        message: "Modificado con éxito",
                        position: "bottom-right",
                        duration: 4000,
                        closable: true,
                        });
                        this.$router.go(-1)
                    })
                    .catch(error => {
                        if (error.response.data.title)
                            this.errors.title = error.response.data.title[0];
                        if (error.response.data.description)
                            this.errors.description = error.response.data.description[0];
                        if (error.response.data.category_id)
                            this.errors.category_id = error.response.data.category_id[0];
                        if (error.response.data.posted)
                            this.errors.posted = error.response.data.posted[0];
                        if (error.response.data.content)
                            this.errors.content = error.response.data.content[0];
                    })
            

        },
        getCategory() {
            this.$axios.get('/api/category/all').then(res => {
                this.categories = res.data
            })
        },
        async getPost() {
            this.post = await this.$axios.get('/api/post/slug/' + this.$route.params.url_clean)
            this.post = this.post.data
        },
        initPost() {
            this.form.title = this.post.title;
            this.form.description = this.post.description;
            this.form.content = this.post.content;
            this.form.category_id = this.post.category_id;
            this.form.posted = this.post.posted;
        },

    },
}
</script>

<style>

</style>
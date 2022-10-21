<template>
    <div>
  
      <h1>Listado de Post</h1>
      <o-button iconLeft="plus" @click="$router.push({ name: 'save' })">Crear</o-button>
  
      <o-table
        :loading="isLoading"
        :data="posts.current_page && posts.data.length == 0 ? [] : posts.data"
      >
        <o-table-column field="id" label="ID" numeric v-slot="p">
          {{ p.row.id }}
        </o-table-column>
        <o-table-column field="title" label="Título" v-slot="p">
          {{ p.row.title }}
        </o-table-column>
        <o-table-column field="posted" label="Posteado" v-slot="p">
          {{ p.row.posted }}
        </o-table-column>
        <o-table-column field="created_at" label="Fecha" v-slot="p">
          {{ p.row.created_at }}
        </o-table-column>
        <o-table-column field="category" label="Categorías" v-slot="p">
          {{ p.row.category.title }}
        </o-table-column>
        <o-table-column field="category" label="Etiquetas" v-slot="p">
          <div v-for="t in p.row.tags" :key="t.id">
            {{ t.title }}
          </div>
        </o-table-column>
        <o-table-column field="url_clean" label="Acciones" v-slot="p">
          <div class="btn btn-slate mr-2"><router-link :to="{ name:'save',params:{ 'url_clean': p.row.url_clean } }">Editar</router-link></div>
          <o-button
            iconLeft="delete"
            rounded
            size="small"
            variant="danger"
            @click="
              deletePostRow = p;
              confirmDeleteActive = true;
            "
            >Eliminar</o-button
          >
        </o-table-column>
      </o-table>
      <br/>
      <o-pagination
        v-if="posts.current_page && posts.data.length > 0"
            @change="updatePage"
            :total="posts.total"
            v-model:current="currentPage"
            :range-before="2"
            :range-after="2"
            order="centered"
            size="small"
            :simple="false"
            :rounded="true"
            :per-page="posts.per_page"
            >
        </o-pagination>
    </div>
      <o-modal v-model:active="confirmDeleteActive">
        <div class="p-4">
          <p>¿Seguro que quieres eliminar el registro selecionado?</p>
        </div>

        <div class="flex flex-row-reverse gap-2 bg-gray-100 p-3">
          <o-button variant="danger" @click="deletePost()">Eliminar</o-button>
          <o-button @click="confirmDeleteActive = false">Cancelar</o-button>
        </div>
      </o-modal>
  </template>

<script>

export default  {
  data() {
    return {
      posts: [],
      isLoading: true,
      currentPage: 1,
      confirmDeleteActive: false,
      deletePostRow: "",
    };
  },
  methods: {
    updatePage() {
      setTimeout(this.listPage, 100);
    },
    listPage() {
      this.isLoading = true;
      this.$axios.get("/api/post?page=" + this.currentPage).then((res) => {
        this.posts = res.data;      
        this.isLoading = false;
      });
    },
    deletePost() {
      this.confirmDeleteActive = false;
      this.posts.data.splice(this.deletePostRow.index, 1);
      this.$axios.delete("/api/post/" + this.deletePostRow.row.id);
      this.$oruga.notification.open({
        message: "Registro eliminado",
        position: "bottom-right",
        variant: "danger",
        duration: 4000,
        closable: true,
      });
    },
  },
  async mounted() {
    this.listPage();
  },
};
</script>

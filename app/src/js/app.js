const app = Vue.createApp({
  data() {
    return {
      comments: [],
      comment: "",
      difficulty: 1,
      sortBy: "date",
      order: "asc",
      difficultyFilterValue: null,
    };
  },
  computed: {
    userId: () => Number(document.querySelector("#app").dataset.user_id),
    subjectId: () => Number(document.querySelector("#app").dataset.id),
  },
  async created() {
    try {
      let response = await fetch(
        `http://tpeweb2careerspath.loc/api/comments?subject_id=${this.subjectId}`
      );
      if (!response.ok) throw new Error(await response.text());
      this.comments = await response.json();
    } catch (error) {
      alert(error);
    }
  },

  methods: {
    async deleteComment(id) {
      let requestOptions = {
        method: "DELETE",
        redirect: "follow",
      };
      try {
        await fetch(
          `http://tpeweb2careerspath.loc/api/comments/${id}`,
          requestOptions
        );
        this.getComments();
      } catch (error) {
        alert("There was an error.");
      }
    },

    async getComments() {
      try {
        let response = await fetch(
          `http://tpeweb2careerspath.loc/api/comments?subject_id=${this.subjectId}`
        );
        if (!response.ok) throw new Error(await response.text());

        this.comments = await response.json();
      } catch (error) {
        alert(error);
      }
    },

    async createComment() {
      const myHeaders = new Headers();
      myHeaders.append("Content-Type", "application/json");

      const raw = JSON.stringify({
        user_id: this.userId,
        subject_id: this.subjectId,
        comment: this.comment,
        difficulty: this.difficulty,
      });
      const requestOptions = {
        method: "POST",
        headers: myHeaders,
        body: raw,
        redirect: "follow",
      };

      try {
        const response = await fetch(
          "http://tpeweb2careerspath.loc/api/comments",
          requestOptions
        );
        if (!response.ok) throw new Error(await response.text());
        else this.getComments();
      } catch (error) {
        alert(error);
      }
    },

    async filterOrUpdate() {
      const sortBy = this.sortBy == "date" ? "id" : this.sortBy;
      let url = `http://tpeweb2careerspath.loc/api/comments?sortBy=${sortBy}&orderBy=${this.order}&subject_id=${this.subjectId}`;
      if (this.difficultyFilterValue != null)
        url += `&filterByDifficulty=${this.difficultyFilterValue}`;

      try {
        let response = await fetch(url);
        this.comments = await response.json();
        if (!response.ok) throw new Error(await response.text());
      } catch (error) {
        alert(error);
      }
    },
  },
});
app.mount("#app");

<template>
  <div class="table-responsive">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>#</th>
          <th>Task</th>
          <th>Label</th>
          <th>Duo Date</th>
          <th>Action</th>
        </tr>
      </thead>
      <draggable
        :list="tasks"
        :options="{ animation: 300 }"
        :element="'tbody'"
        @change="updatePriority"
      >
        <tr v-for="(task, index) in tasks" :key="task.id" style="cursor: move;">
          <th>{{ index + 1 }}</th>
          <th>
            <p style="margin: 0;">
              <strong>{{ task.name }}</strong>
            </p>
            <p style="font-size: 0.75rem;margin: 0;">
              {{ task.description }}
            </p>
          </th>
          <th>
            <span
              v-show="task.label == 'urgent'"
              class="badge badge-pill badge-danger"
              >{{ task.label }}</span
            >
            <span
              v-show="task.label == 'high'"
              class="badge badge-pill badge-warning"
              >{{ task.label }}</span
            >
            <span
              v-show="task.label == 'medium'"
              class="badge badge-pill badge-info"
              >{{ task.label }}</span
            >
            <span
              v-show="task.label == 'low'"
              class="badge badge-pill badge-success"
              >{{ task.label }}</span
            >
          </th>
          <th>{{ task.due_date ? task.due_date : 'Not set' }}</th>
          <th style="cursor: auto;">
            <a
              :href="`/tasks/${task.id}/edit`"
              class="btn btn-info btn-sm mb-1"
            >
              <i class="fas fa-edit"></i>
            </a>

            <form
              style="display: inline-block;"
              :action="`/tasks/${task.id}`"
              method="POST"
              onsubmit="return confirm('Are you sure?');"
            >
              <input type="hidden" name="_token" :value="csrfToken" />
              <input type="hidden" name="_method" value="delete" />
              <button type="submit" class="btn btn-danger btn-sm mb-1">
                <i class="far fa-trash-alt"></i>
              </button>
            </form>
          </th>
        </tr>
      </draggable>
    </table>
  </div>
</template>

<script>
import draggable from 'vuedraggable'
import axios from 'axios'

export default {
  props: {
    taskData: {
      type: [Object, Array]
    }
  },
  components: {
    draggable
  },
  data() {
    return {
      csrfToken: document.head.querySelector('meta[name="csrf-token"]').content,
      tasks: this.taskData
    }
  },
  created() {
    // this.tasks = this.taskData
  },
  methods: {
    updatePriority(e) {
      // craete new tasks array with new priority
      this.tasks.map((taskData, index) => {
        taskData.priority = index + 1
      })

      // update in backend
      axios
        .post('/tasks/update-priority', {
          tasks: this.tasks
        })
        .then(res => {
          console.log(res)
        })
        .catch(error => console.log(error))
    }
  }
}
</script>

import axios from "axios";

export default {
  getEmployee: (employeeId) => {
    return axios.get(`localhost/api/employee/${employeeId}`)
  },
  getEmployees: () => {
    return axios.get(`localhost/api/employee`)
  },
  createEmployee: (employee) => {
    return axios.post(`localhost/api/employee`, employee)
  },
  getVaccine: (vaccineId) => {
    return axios.get(`localhost/api/vaccine/${vaccineId}`)
  },
  getVaccines: () => {
    return axios.get(`localhost/api/vaccine`)
  },
  createVaccine: (vaccine) => {
    return axios.post(`localhost/api/vaccine`, vaccine)
  }
}
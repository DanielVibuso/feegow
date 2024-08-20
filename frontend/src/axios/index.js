import axios from "axios";

const token = "77d5c0b4-f418-4278-9c75-8aa02f289fe5|UB4iV7V89oFQbJGbCSyQwPvzTSW017S2myoOuZ0Tb3b39d6f"; // Substitua pelo token real

axios.defaults.baseURL = "http://localhost/api"; 
axios.defaults.headers.common["Authorization"] = `Bearer ${token}`;


export default {
  getEmployee: (employeeId) => {
    return axios.get(`/employee/${employeeId}`);
  },
  getEmployees: (page = 1, perPage = 15) => {
    return axios.get('http://localhost/api/employee', {
      params: {
        page: page,
        per_page: perPage
      }
    });
  },
  createEmployee: (employee) => {
    return axios.post(`/employee`, employee);
  },
  updateEmployee: (employeeId, employee) => {
    return axios.put(`/employee/${employeeId}`, employee);
  },
  getVaccine: (vaccineId) => {
    return axios.get(`/vaccine/${vaccineId}`);
  },
  getVaccines: (page = 1, perPage = 15) => {
    return axios.get(`/vaccine`, {
      params: {
        page: page,
        per_page: perPage
      }
    });
  },
  createVaccine: (vaccine) => {
    return axios.post(`/vaccine`, vaccine);
  },
  updateVaccine: (vaccineId, vaccine) => {
    return axios.put(`/vaccine/${vaccineId}`, vaccine);
  },
  getShots: (page, perPage, employeeId) => {
    return axios.get(`/employee-lot/${employeeId}/lot`, {
      params: {
        page: page,
        per_page: perPage
      }
    });
  },
  getLots: (page, perPage, vaccineId) => {
    return axios.get(`/lot`, {
      params: {
        vaccine_id: vaccineId,
        page: page,
        per_page: perPage
      }
    });
  },
}
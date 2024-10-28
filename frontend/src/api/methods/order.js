import axiosInstance from "../../utils/AxiosInstance";

export async function saveOrder(params) {
  try {
    const response = await axiosInstance.post("/order/save", {
      params: params,
    });
    return response.data;
  } catch (error) {
    console.error("Error on order save:", error);
    throw error;
  }
}

export async function getOrdersList() {
  try {
    const response = await axiosInstance.get("/order/list");
    return response.data;
  } catch (error) {
    console.error("Error on get orders list:", error);
    throw error;
  }
}

export async function getOrdersListFiltered(params) {
  try {
    const response = await axiosInstance.get("/order/filter", {
      params: params,
    });
    return response.data;
  } catch (error) {
    console.error("Error on get orders list filtered:", error);
    throw error;
  }
}

export async function deleteOrder(orderId) {
  try {
    const response = await axiosInstance.delete("/order/archive/" + orderId);
    return response.data;
  } catch (error) {
    console.error("Error on delete order:", error);
    throw error;
  }
}
import axiosInstance from "../../utils/AxiosInstance";

export async function saveProduct(params) {
  try {
    const response = await axiosInstance.post("product/save", {
      params: params,
    });
    return response.data;
  } catch (error) {
    console.error("Error on product save:", error);
    throw error;
  }
}

export async function getProductList() {
  try {
    const response = await axiosInstance.get("product/list");
    return response.data;
  } catch (error) {
    console.error("Error on get product list:", error);
    throw error;
  }
}

export async function deleteProduct(productId) {
  try {
    const response = await axiosInstance.delete("product/archive/" + productId);
    return response.data;
  } catch (error) {
    console.error("Error on delete product:", error);
    throw error;
  }
}
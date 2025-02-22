//Modal for setting order status
document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('editOrderModal');
    const closeModalButton = document.getElementById('closeModal');
    const editOrderForm = document.getElementById('editOrderForm');
    const modalOrderId = document.getElementById('modalOrderId');
  
    // Handle "Edit" button clicks
    document.querySelectorAll('.edit-order-btn').forEach(button => {
      button.addEventListener('click', () => {
        const orderId = button.getAttribute('data-order-id');
        modalOrderId.value = orderId;
        modal.classList.remove('hidden');
        modal.classList.add('flex'); 
      });
    });
  
    // Handle modal close
    closeModalButton.addEventListener('click', () => {
      modal.classList.add('hidden');
    });
  
  });
  
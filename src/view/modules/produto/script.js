const dismissSuccessMessage = document.getElementById('dismissSuccessMessage')

dismissSuccessMessage?.addEventListener('click', () => {
  document.getElementById('successMessage').classList.add('hidden')
})

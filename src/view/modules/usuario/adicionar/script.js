const dismissErrorMessages = document.querySelectorAll('.error-message')
const dismissErrorMessageContainers = document.querySelectorAll(
  '.error-message-container'
)
const toggleSenha = document.getElementById('toggleSenha')
const senha = document.getElementById('senha')
const toggleSenhaIcon = document.getElementById('toggleSenhaIcon')

dismissErrorMessages?.forEach((button, index) =>
  button.addEventListener('click', () => {
    dismissErrorMessageContainers[index].classList.add('hidden')
  })
)

toggleSenha.addEventListener('click', () => {
  const type = senha.getAttribute('type') === 'password' ? 'text' : 'password'
  senha.setAttribute('type', type)

  if (type === 'password') {
    toggleSenhaIcon.classList.remove('fa-eye-slash')
    toggleSenhaIcon.classList.add('fa-eye')
  } else {
    toggleSenhaIcon.classList.remove('fa-eye')
    toggleSenhaIcon.classList.add('fa-eye-slash')
  }
})

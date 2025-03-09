 // Remplacez par votre nom Docker Hub    https://github.com/faah28/gestion_etablissement.git
     pipeline { 
    agent any

    
    stages {
        stage('Cloner le code') {
            steps {
                git 'https://github.com/faah28/gestion_etablissement.git'
            }
        }

        stage('Construire les images Docker') {
            steps {
                script {
                    bat 'docker-compose build'
                }
            }
        }
    }
        

    post {
        success {
            echo '🎉 Pipeline réussie et artéfact publié !'
        }
        failure {
            echo '⚠️ Erreur dans la pipeline, vérifiez les logs.'
        }
    }
}

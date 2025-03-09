pipeline {
    agent any

    stages {
        stage('Cloner le code') {
            steps {
                git url: 'https://github.com/faah28/gestion_etablissement.git', branch: 'main'
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

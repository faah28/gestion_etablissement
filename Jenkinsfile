 // Remplacez par votre nom Docker Hub    https://github.com/faah28/gestion_etablissement.git
       pipeline { 
    agent any

    environment {
        LOCAL_REGISTRY = 'localhost:5000'
        REMOTE_REGISTRY = 'docker.io/limatou4'
        ENV = env.ENV ?: 'dev'  // Définit une valeur par défaut si ENV n'est pas défini
    }

    stages {
        stage('Cloner le code') {
            steps {
                git 'https://github.com/faah28/gestion_etablissement.git'
            }
        }

        stage('Construire les images Docker') {
            steps {
                script {
                    bat "docker-compose build"
                }
            }
        }

        stage('Push de l\'image Docker') {
            steps {
                script {
                    def registry = (ENV == 'dev' || ENV == 'staging') ? LOCAL_REGISTRY : REMOTE_REGISTRY
                    def imageTag = "${registry}/gestionEtablissement:${BUILD_NUMBER}"

                    bat "docker tag gestionEtablissement ${imageTag}"
                    bat "docker push ${imageTag}"
                    echo "✅ Image Docker poussée vers ${registry}"
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

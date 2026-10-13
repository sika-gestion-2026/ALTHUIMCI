# Dockerfile — ALTHIUM SARL — Déploiement Coolify
FROM node:20-alpine

WORKDIR /app

# Copie package.json & package-lock.json
COPY package.json ./

# Installation des dépendances (aucune pour ce projet statique)
RUN npm install --production || true

# Copie des fichiers du projet
COPY . .

# Exposition du port (Coolify gère le mapping automatique)
EXPOSE 3000

# Variable d'environnement pour le port
ENV PORT=3000

# Commande de démarrage
CMD ["node", "serve.js"]

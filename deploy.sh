#!/usr/bin/env bash
# Deploy de berrinchitosdent.com: rsync de public/ al server.
# --delete: lo que no está en el repo, no está en producción.
#
# Los datos del servidor NO viven acá. Copiá deploy.env.example a deploy.env,
# completalo, y ese archivo queda fuera de git.
set -euo pipefail

cd "$(dirname "$0")"

if [[ ! -f deploy.env ]]; then
  echo "Falta deploy.env — copiá deploy.env.example y completalo:" >&2
  echo "  cp deploy.env.example deploy.env" >&2
  exit 1
fi

# shellcheck disable=SC1091
source deploy.env

: "${DEPLOY_HOST:?falta DEPLOY_HOST en deploy.env}"
: "${DEPLOY_PATH:?falta DEPLOY_PATH en deploy.env}"
: "${DEPLOY_USER:=deploy}"
: "${DEPLOY_KEY:=$HOME/.ssh/id_rsa}"

# Sin este guard, un public/ vacío más --delete borra producción entera.
if [[ -z "$(ls -A public 2>/dev/null)" ]]; then
  echo "public/ está vacío — abortando para no borrar producción." >&2
  exit 1
fi

rsync -avz --delete \
  -e "ssh -i ${DEPLOY_KEY}" \
  public/ \
  "${DEPLOY_USER}@${DEPLOY_HOST}:${DEPLOY_PATH}"

echo "Deploy OK → https://berrinchitosdent.com"

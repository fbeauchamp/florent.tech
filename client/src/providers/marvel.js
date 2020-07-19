
export const marvelApiUrl = 'http://127.0.0.1:8000/marvel/'

export async function getSerie (id) {
  const res = await fetch(marvelApiUrl + 'serie/' + id)
  return res.json()
}

export async function getSeries (opts) {
  const res = await fetch(marvelApiUrl + 'series')
  return res.json()
}

export async function getCharacter (id) {
  const res = await fetch(marvelApiUrl + 'character/' + id)
  return res.json()
}

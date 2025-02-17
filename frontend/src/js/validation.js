function validateEmailInput(email) {
  if (email.length < 10) return false; // Minimaal 10 tekens lang

  const phishingKeywords = [
    "bank",
    "verifieer",
    "reset",
    "wachtwoord",
    "factuur",
    "winnaar",
    "betaling",
  ];
  return !phishingKeywords.some((keyword) =>
    email.toLowerCase().includes(keyword)
  );
}

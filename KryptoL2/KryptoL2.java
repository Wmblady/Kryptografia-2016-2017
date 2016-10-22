import java.nio.charset.StandardCharsets;
import java.util.Base64;

import javax.crypto.BadPaddingException;
import javax.crypto.Cipher;
import javax.crypto.spec.IvParameterSpec;
import javax.crypto.spec.SecretKeySpec;
import javax.xml.bind.DatatypeConverter;

public class KryptoL2 {
	
	public static String encrypt(String text, String key, String initVector) {
		
		byte[] keyB = DatatypeConverter.parseHexBinary(key);
		byte[] dataToSendB = text.getBytes(StandardCharsets.UTF_8);
		Cipher c = null;
		SecretKeySpec k = null;
		try {
			c = Cipher.getInstance("AES/CBC/PKCS5Padding");
			IvParameterSpec iv = new IvParameterSpec(DatatypeConverter.parseHexBinary(initVector));
			k = new SecretKeySpec(keyB, "AES");
			c.init(Cipher.ENCRYPT_MODE, k, iv);
		} catch (Exception e) {
			System.out.println(e.getMessage());
		}
		
		byte[] encryptedData = null;
		
		try {
			encryptedData = c.doFinal(dataToSendB);
		} catch (Exception e1) {
			System.out.println("meh0");
		}
		
		return Base64.getEncoder().encodeToString(encryptedData);
	}
	
	public static String decrypt(String encryptedData, String key, String initVector) {
		
		byte[] keyB = DatatypeConverter.parseHexBinary(key);
		Cipher c = null;
		
		SecretKeySpec k = null;
		try {
			c = Cipher.getInstance("AES/CBC/PKCS5Padding");
			IvParameterSpec iv = new IvParameterSpec(DatatypeConverter.parseHexBinary(initVector));
			k = new SecretKeySpec(keyB, "AES");
			c.init(Cipher.DECRYPT_MODE, k, iv);
		} catch (Exception e) {
			System.out.println(e.getMessage());
			System.out.println("meh1");
		}
		
		byte[] data = null;
		String text = "";
		try {
			data = c.doFinal(Base64.getDecoder().decode(encryptedData));
			text = new String(data, StandardCharsets.UTF_8);
		} catch (BadPaddingException e2) {
			//System.out.println(e2.getMessage());
			text = "0x0";
		}	catch (Exception e) {
			//System.out.println(e.getMessage());
			text = "0x0";
		}
		return text;
	}
	
	public static void tryBruteForceA(String encrypted2, String sufix, String iv, int start, int end) {
		/*8 zagniezdzonych petli do stworzenia wszystkich kombinacji 9znakowych skladajacych sie ze znakow 0-9 oraz a-f. W srodku dekodowanie i sprawdzenie czy przebieglo ono z powodzeniem*/
		
		char[] hexTab = {'0', '1', '2', '3', '4', '5', '6', '7', '8','9', 'a', 'b', 'c', 'd', 'e', 'f'};
		String actual = "";
		String toBruteForce = "";
		String decText = "";
		
		float counter = 0.0f;
		for(int i1 = start; i1 < end; i1++) {
			actual += hexTab[i1];
			for(int i2 = 11; i2 < 16; i2++) {
				actual += hexTab[i2];
				counter+= 1.0;
				System.out.println(counter/(((end - start))* 16.0) * 100.0 + "%");
				for(int i3 = 0; i3 < 16; i3++) {
					actual += hexTab[i3];
					for(int i4 = 0; i4 < 16; i4++) {
						actual += hexTab[i4];
						for(int i5 = 0; i5 < 16; i5++) {
							actual += hexTab[i5];
							for(int i6 = 0; i6 < 16; i6++) {
								actual += hexTab[i6];
								for(int i7 = 0; i7 < 16; i7++) {
									actual += hexTab[i7];
									for(int i8 = 0; i8 < 16; i8++) {
										actual += hexTab[i8];
										toBruteForce = actual + sufix;
										decText = decrypt(encrypted2, toBruteForce, iv);
										if (checkIfEnd(decText) == true) {
											System.out.println("Uzyty klucz: " + toBruteForce);
										};
										actual = actual.substring(0, actual.length()-1);
									}
									actual = actual.substring(0, actual.length()-1);
								}
								actual = actual.substring(0, actual.length()-1);
							}
							actual = actual.substring(0, actual.length()-1);
						}
						actual = actual.substring(0, actual.length()-1);
					}
					actual = actual.substring(0, actual.length()-1);
				}
				actual = actual.substring(0, actual.length()-1);
			}
			actual = actual.substring(0, actual.length()-1);
		}
			
	}
	
	public static void tryBruteForceB(String encrypted2, String sufix, String iv, int start, int end) {
		
		/*9 zagniezdzonych petli do stworzenia wszystkich kombinacji 9znakowych skladajacych sie ze znakow 0-9 oraz a-f. W srodku dekodowanie i sprawdzenie czy przebieglo ono z powodzeniem*/
		char[] hexTab = {'0', '1', '2', '3', '4', '5', '6', '7', '8','9', 'a', 'b', 'c', 'd', 'e', 'f'};
		String actual = "";
		String toBruteForce = "";
		String decText = "";
		
		float counter = 0.0f;
		for(int i1 = start; i1 < end; i1++) {
			actual += hexTab[i1];
			for(int i2 = 0; i2 < 11; i2++) {
				actual += hexTab[i2];
				counter+= 1.0;
				System.out.println(counter/(((end - start))* 16.0) * 100.0 + "%");
				for(int i3 = 0; i3 < 16; i3++) {
					actual += hexTab[i3];
					for(int i4 = 0; i4 < 16; i4++) {
						actual += hexTab[i4];
						for(int i5 = 0; i5 < 16; i5++) {
							actual += hexTab[i5];
							for(int i6 = 0; i6 < 16; i6++) {
								actual += hexTab[i6];
								for(int i7 = 0; i7 < 16; i7++) {
									actual += hexTab[i7];
									for(int i8 = 0; i8 < 16; i8++) {
										actual += hexTab[i8];
										for(int i9 = 0; i9 < 16; i9++) {
											actual += hexTab[i9];
											toBruteForce = actual + sufix;
											decText = decrypt(encrypted2, toBruteForce, iv);
											if (checkIfEnd(decText) == true) {
												System.out.println("Uzyty klucz: " + toBruteForce);
											};
											actual = actual.substring(0, actual.length()-1);
										}
										actual = actual.substring(0, actual.length()-1);
									}
									actual = actual.substring(0, actual.length()-1);
								}
								actual = actual.substring(0, actual.length()-1);
							}
							actual = actual.substring(0, actual.length()-1);
						}
						actual = actual.substring(0, actual.length()-1);
					}
					actual = actual.substring(0, actual.length()-1);
				}
				actual = actual.substring(0, actual.length()-1);
			}
			actual = actual.substring(0, actual.length()-1);
		}
			
	}
	
	public static boolean checkIfEnd(String decText) {
		/*char [] availableSymbols = {' ', '"', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'A', 'a', '¹', 'B', 'b', 'C', 'c', 'Æ', 'æ', 'D', 'd', 'E', 'e', 'Ê', 'ê', 'F', 'f', 'G', 'g', 'H', 'h', 'I', 'i', 'J', 'j', 'K', 'k', 'L', 'l', '£', '³', 'M', 'm', 'N', 'n', 'Ñ', 'ñ', 'O', 'o', 'P', 'p', 
				'R', 'r', 'S', 's', 'Œ', 'œ', 'T', 't', 'U', 'u', 'Ó', 'ó', 'Q', 'q', 'V', 'v', 'W', 'w', 'X', 'x', 'Y', 'y', 'Z', 'z', '¯', '¿', '', 'Ÿ', '(', ')', '[', ']', '{', '}', ',', '.', '-', ':',  '~', ';', '?', '/', '%', '\'', '\0'};*/
		
		/*Tablica dozwolonych symboli, im wiecej znakow tym wieksza szansa, ze odnajdzie tekst, ale bedzie dzialac wolniej*/
		char [] availableSymbols = {' ', '"', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'A', 'a', '¹', 'B', 'b', 'C', 'c', 'Æ', 'æ', 'D', 'd', 'E', 'e', 'Ê', 'ê', 'F', 'f', 'G', 'g', 'H', 'h', 'I', 'i', 'J', 'j', 'K', 'k', 'L', 'l', '£', '³', 'M', 'm', 'N', 'n', 'Ñ', 'ñ', 'O', 'o', 'P', 'p', 
				'R', 'r', 'S', 's', 'Œ', 'œ', 'T', 't', 'U', 'u', 'Ó', 'ó', 'Q', 'q', 'V', 'v', 'W', 'w', 'X', 'x', 'Y', 'y', 'Z', 'z', '¯', '¿', '', 'Ÿ', '(', ')', ',', '.', '-', ':',  '~', ';', '?', '/', '%', '\'', '\0'};
		char checking;
		boolean stop = false;
		/*Zalozenie w ramach optymalizacji, ze dekodowany tekst ma co najmniej 10 znakow*/
		if(decText.length() < 10)
			return false;
		
		/*Jesli wykryto znak spoza dozwolonych, tekst jest odrzucany*/
		for(int i=0; i<15 && i<decText.length() && stop == false; i++) {
			checking = decText.charAt(i);
			for(int j=0; j<availableSymbols.length; j++) {
				if(availableSymbols[j] == checking)
					break;
				else if(j == availableSymbols.length - 1)
					stop = true;
			}
		}
		if(stop == false) {
			System.out.println(decText.length() + " ----------- " + decText);
			return true;
		}
		
		return false;
	}
	
	public static void main(String[] args) {
		

		int start = 6;
		int end = 7;
		/* ----------- Do wielordzeniowosci (odkad dokad patrzac po najbardziej zewnetrznej petli dane uruchomienie programu ma dekodowac  ---------------- */
		if(args.length == 2) {
			start = Integer.parseInt(args[0]);
			end = Integer.parseInt(args[1]);
		}
		/* ----------- Podpunkt a)  ---------------- */
		//tryBruteForceA("/grVmNl7glvW+qWhM/9BraUkIHDh2rMT5+P6pkFcMx9KaDCEtzrNlt1N99hCVuVES4N0CxaABymdPeb478WiX+7iM11VUveO2pN3ygDiVYj6EUYuuljK5RZII173EC5MRoBfXHg5odp6kelQ0yEeR/wGznKzpAQOfxQwlqrIjrdUjh50tAEoxEAc9TJUy8uDV81zr969cqh1xHqpLzhyYw==", "c349204c210d315b02790d553de67418505f8fa7c317b79ab9a0832c", "f8a54e90e1cbaf64979b0f508a9fb48c", start, end);
		
		/* ----------- Podpunkt b)  ---------------- */
		tryBruteForceB("7hI8JhAEQtUEDEjh1CGO/eS1E420cMVy94cSlKd/+Xb8KJjBLAF8DN7g3KrtXfh3", "1fafbbadc13aa1335cf0046dbae4fdf53683e96461d914bdc37f8cd", "6a099549d163533275efdac89f9ad5a7", start, end);
		
		/* ----------- Przyklad dzialania na "Ala ma kota..." ---------------- */
		
		/*String enc = encrypt("Ala ma kota. Kot ma, ale... to jednak ona go posiada. Jednak¿e gdy przeczytamy to ponownie to...", "b98f592d18734e96bc82e08cf75b3539c384262b3adf1d2a02ed68aa0e4f0688", "2ff3c2fe09eb6349105ce320aa142725");
		System.out.println(decrypt(enc, "b98f592d18734e96bc82e08cf75b3539c384262b3adf1d2a02ed68aa0e4f0688", "2ff3c2fe09eb6349105ce320aa142725"));
		tryBruteForce(enc, "18734e96bc82e08cf75b3539c384262b3adf1d2a02ed68aa0e4f0688", "4ad92dea8ad3d37e86601a98b33e8fb6", 0, 1);*/
	}
}

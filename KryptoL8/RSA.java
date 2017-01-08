import java.security.SecureRandom;
import java.math.BigInteger;

public class RSA {
	private BigInteger e, d, n;
	// e - klucz publiczny 
	// d - klucz prywatny
	// n - p*q, gdzie p i q  to losowe liczby pierwsze
	
	private int length = 22;
	
	public synchronized BigInteger encrypt(BigInteger msg) {
		return fastPow(msg, e).mod(n);
		
		//return msg.modPow(e, n);
	}
	
	public synchronized BigInteger decrypt(BigInteger msg) {
		return fastPow(msg, d).mod(n);
		
		//return msg.modPow(d, n);
	}

	public void generateKey() {
		SecureRandom r = new SecureRandom();
		BigInteger p = new BigInteger(length/2, 100, r);
	    BigInteger q = new BigInteger(length/2, 100, r);
		BigInteger pMinus1 = p.subtract(BigInteger.ONE);
		BigInteger qMinus1 = q.subtract(BigInteger.ONE);
		n = p.multiply(q);
		
		// m = (p-1)(q-1)
		BigInteger m = pMinus1.multiply(qMinus1);
		
		e = new BigInteger("3");
		
		//O(ln^2 b), gdzie b to mniejsza liczba
		while(m.gcd(e).intValue() > 1) {
			e = e.add(new BigInteger("2"));
		}
		
		d = e.modInverse(m);	
	}
	
	public static BigInteger modInversion(BigInteger m, BigInteger e) {
		BigInteger inv, m1, m3, e1, e3, t1, t3, q;
		BigInteger iter;
		
		m1 = BigInteger.ONE;
		m3 = m;
		e1 = BigInteger.ONE;
		e3 = e;
		
		iter = BigInteger.ONE;
		while (e3.compareTo(BigInteger.ZERO) != 0) {
			q = m3.divide(e3);
			t3 = m3.mod(e3);
			t1 = m1.add(q.multiply(e1));
			
			m1 = e1; e1 = t1; m3 = e3; e3 = t3;
			iter = iter.subtract(BigInteger.ONE);
		}
		
		if(m3.compareTo(BigInteger.ONE) != 0) {
			return BigInteger.ZERO;
		}
		if(iter.compareTo(BigInteger.ZERO) == -1) {
			inv = e.subtract(m1);
		} else {
			inv = m1;
		}
		return inv;
	}
	
	// 2 * log2n -> ilosc mnozen -> O(logn), samo mnozenie to O(n^1.6) mnozenie karatsuby
	// O(M(n*exponent))
	public static BigInteger fastPow(BigInteger x, BigInteger y) {
		/*BigInteger z = new BigInteger("1");
		if (y.compareTo(BigInteger.ZERO) == 0)
			return BigInteger.ONE;
		if(y.mod(new BigInteger("2")).compareTo(BigInteger.ONE) == 0) {
			return x.multiply(fastPow(x, y.subtract(BigInteger.ONE)));
		} else
			z = fastPow(x, y.divide(new BigInteger("2")));
		return z.multiply(z);*/
		
		BigInteger z = new BigInteger("2");
		if (y.compareTo(BigInteger.ZERO) == 0)
			return BigInteger.ONE;
		if(y.mod(z).compareTo(BigInteger.ONE) == 0) {
			return x.multiply(fastPow(x, y.subtract(BigInteger.ONE)));
		} else
			z = fastPow(x, y.divide(z));
		return z.multiply(z);
	}
	
	public BigInteger getN() {
		return n;
	}
	
	public BigInteger getE() {
		return e;
	}
	
	static long powToCRT(int a, int b, int MOD)
	{
	    long x=1,y=a;
	    while(b > 0)
	    {
	        if(b%2 == 1)
	        {
	            x=(x*y);
	            if(x>MOD) x%=MOD;
	        }
	        y = (y*y);
	        if(y>MOD) y%=MOD;
	        b /= 2;
	    }
	    return x;
	}
	
	public static void main(String[] args) {
		/*RSA rsa = new RSA();
		rsa.generateKey();
		
		String test = "ko";
		System.out.println("Przed: " + test);
		BigInteger plainTest = new BigInteger(test.getBytes());
		
		BigInteger cipher = rsa.encrypt(plainTest);
		System.out.println("Po: " + cipher);
		
		BigInteger decrypted = rsa.decrypt(cipher);
		
		System.out.println("Powrot: " + new String(decrypted.toByteArray()));*/
		

	}
}

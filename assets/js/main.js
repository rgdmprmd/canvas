const base_url = "http://localhost/canvas/";

function encrypt(str) {
	let encoded = "";
	str = btoa(str);
	str = btoa(str);

	for (i = 0; i < str.length; i++) {
		let a = str.charCodeAt(i);
		let b = a ^ 69; // bitwise XOR with any number, e.g. 123

		encoded = encoded + String.fromCharCode(b);
	}

	encoded = btoa(encoded);
	return encoded;
}

// let t = encrypt("whose your daddy");
// console.log(t);

function decrypt(encoded) {
	let str = "";
	encoded = atob(encoded);

	for (i = 0; i < encoded.length; i++) {
		let b = encoded.charCodeAt(i);
		let a = b ^ 69;

		str = str + String.fromCharCode(a);
	}

	return atob(atob(str));
}

// let r = decrypt(t);
// console.log(r);

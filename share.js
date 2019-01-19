function sociallink(stype) {
		var pageTitle = encodeURIComponent(document.title);
		var shareUrl = window.document.location.href;
		var wOption = 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=800';

		switch(stype) {
			case "google":
				window.open("https://plus.google.com/share?url=" + shareUrl, '', wOption);
				break;
			case "facebook":
				window.open("http://www.facebook.com/share.php?u=" + shareUrl, '', wOption);
				break;
			case "line":
				window.open("http://line.me/R/msg/text/?" + pageTitle + '%0D%0A'+ shareUrl, '',  wOption);
				break;
			case "twitter":
				window.open("http://twitter.com/home?status=" + pageTitle + "+" + shareUrl, '', wOption);
				break;
			case "linkedin":
				window.open("http://www.linkedin.com/shareArticle?mini=true&url=" + shareUrl + "&title=" + pageTitle, '', wOption);
			break;
			case "weibo":
				 window.open('http://v.t.sina.com.cn/share/share.php?url='.concat(encodeURIComponent(location.href)), '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');
				break;
			default:
				alert("無法使用");
				break;
		}
	}
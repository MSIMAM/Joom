// import * as React from 'react';
// import Button from '@mui/material/Button';
// import Dialog from '@mui/material/Dialog';
// import DialogActions from '@mui/material/DialogActions';
// import DialogContent from '@mui/material/DialogContent';
// import DialogContentText from '@mui/material/DialogContentText';
// import DialogTitle from '@mui/material/DialogTitle';
// import Paper from '@mui/material/Paper';
// import Draggable from 'react-draggable';

// function PaperComponent(props) {
//   return (
//     <Draggable
//       handle="#draggable-dialog-title"
//       cancel={'[class*="MuiDialogContent-root"]'}
//     >
//       <Paper {...props} />
//     </Draggable>
//   );
// }

// export default function DraggableDialog() {
//   const [open, setOpen] = React.useState(false);

//   const handleClickOpen = () => {
//     setOpen(true);
//   };

//   const handleClose = () => {
//     setOpen(false);
//   };

//   return (
//     <React.Fragment>
//       <Button variant="outlined" onClick={handleClickOpen}>
//         Open draggable dialog
//       </Button>
//       <Dialog
//         open={open}
//         onClose={handleClose}
//         PaperComponent={PaperComponent}
//         aria-labelledby="draggable-dialog-title"
//       >
//         <DialogTitle style={{ cursor: 'move' }} id="draggable-dialog-title">
//           Subscribe
//         </DialogTitle>
//         <DialogContent>
//           <DialogContentText>
//             To subscribe to this website, please enter your email address here. We
//             will send updates occasionally.
//           </DialogContentText>
//         </DialogContent>
//         <DialogActions>
//           <Button autoFocus onClick={handleClose}>
//             Cancel
//           </Button>
//           <Button onClick={handleClose}>Subscribe</Button>
//         </DialogActions>
//       </Dialog>
//     </React.Fragment>
//   );
// }

















// import * as React from 'react';
// import Button from '@mui/material/Button';
// import Dialog from '@mui/material/Dialog';
// import DialogActions from '@mui/material/DialogActions';
// import DialogContent from '@mui/material/DialogContent';
// import DialogContentText from '@mui/material/DialogContentText';
// import DialogTitle from '@mui/material/DialogTitle';
// import Slide from '@mui/material/Slide';

// const Transition = React.forwardRef(function Transition(props, ref) {
//   return <Slide direction="up" ref={ref} {...props} />;
// });

// export default function AlertDialogSlide() {
//   const [open, setOpen] = React.useState(false);

//   const handleClickOpen = () => {
//     setOpen(true);
//   };

//   const handleClose = () => {
//     setOpen(false);
//   };

//   return (
//     <React.Fragment>
//       <Button variant="outlined" onClick={handleClickOpen}>
//         Slide in alert dialog
//       </Button>
//       <Dialog
//         open={open}
//         TransitionComponent={Transition}
//         keepMounted
//         onClose={handleClose}
//         aria-describedby="alert-dialog-slide-description"
//       >
//         <DialogTitle>{"Use Google's location service?"}</DialogTitle>
//         <DialogContent>
//           <DialogContentText id="alert-dialog-slide-description">
//             Let Google help apps determine location. This means sending anonymous
//             location data to Google, even when no apps are running.
//           </DialogContentText>
//         </DialogContent>
//         <DialogActions>
//           <Button onClick={handleClose}>Disagree</Button>
//           <Button onClick={handleClose}>Agree</Button>
//         </DialogActions>
//       </Dialog>
//     </React.Fragment>
//   );
// }





























import * as React from 'react';
import Button from '@mui/material/Button';
import Dialog from '@mui/material/Dialog';
import ListItemText from '@mui/material/ListItemText';
import ListItem from '@mui/material/ListItem';
import List from '@mui/material/List';
import Divider from '@mui/material/Divider';
import AppBar from '@mui/material/AppBar';
import Toolbar from '@mui/material/Toolbar';
import IconButton from '@mui/material/IconButton';
import Typography from '@mui/material/Typography';
import CloseIcon from '@mui/icons-material/Close';
import Slide from '@mui/material/Slide';

const Transition = React.forwardRef(function Transition(props, ref) {
  return <Slide direction="up" ref={ref} {...props} />;
});

export default function FullScreenDialog() {
  const [open, setOpen] = React.useState(false);

  const handleClickOpen = () => {
    setOpen(true);
  };

  const handleClose = () => {
    setOpen(false);
  };

  return (
    <React.Fragment>
      <Button variant="outlined" onClick={handleClickOpen}>
        Open full-screen dialog
      </Button>
      <Dialog
        fullScreen
        open={open}
        onClose={handleClose}
        TransitionComponent={Transition}
      >
        <AppBar sx={{ position: 'relative' }}>
          <Toolbar>
            <IconButton
              edge="start"
              color="inherit"
              onClick={handleClose}
              aria-label="close"
            >
              <CloseIcon />
            </IconButton>
            <Typography sx={{ ml: 2, flex: 1 }} variant="h6" component="div">
              Sound
            </Typography>
            <Button autoFocus color="inherit" onClick={handleClose}>
              save
            </Button>
          </Toolbar>
        </AppBar>
        <List>
          <ListItem button>
            <ListItemText primary="Phone ringtone" secondary="Titania" />
          </ListItem>
          <Divider />
          <ListItem button>
            <ListItemText
              primary="Default notification ringtone"
              secondary="Tethys"
            />
          </ListItem>
        </List>
      </Dialog>
    </React.Fragment>
  );
}































// import * as React from 'react';
// import Stack from '@mui/material/Stack';
// import TrapFocus from '@mui/material/Unstable_TrapFocus';
// import CssBaseline from '@mui/material/CssBaseline';
// import AppBar from '@mui/material/AppBar';
// import Toolbar from '@mui/material/Toolbar';
// import Container from '@mui/material/Container';
// import IconButton from '@mui/material/IconButton';
// import MenuIcon from '@mui/icons-material/Menu';
// import Paper from '@mui/material/Paper';
// import Fade from '@mui/material/Fade';
// import Button from '@mui/material/Button';
// import Box from '@mui/material/Box';
// import Typography from '@mui/material/Typography';

// export default function CookiesBanner() {
//   const [bannerOpen, setBannerOpen] = React.useState(true);

//   const closeBanner = () => {
//     setBannerOpen(false);
//   };

//   return (
//     <React.Fragment>
//       <CssBaseline />
//       <AppBar position="fixed" component="nav">
//         <Toolbar>
//           <IconButton size="large" edge="start" color="inherit" aria-label="menu">
//             <MenuIcon />
//           </IconButton>
//         </Toolbar>
//       </AppBar>
//       <Container component="main" sx={{ pt: 3 }}>
//         <Toolbar />
//         <Typography paragraph>
//           Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
//           tempor incididunt ut labore et dolore magna aliqua. Rhoncus dolor purus non
//           enim praesent elementum facilisis leo vel. Risus at ultrices mi tempus
//           imperdiet.
//         </Typography>
//         <Typography paragraph>
//           Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
//           tempor incididunt ut labore et dolore magna aliqua. Rhoncus dolor purus non
//           enim praesent elementum facilisis leo vel. Risus at ultrices mi tempus
//           imperdiet.
//         </Typography>
//       </Container>
//       <TrapFocus open disableAutoFocus disableEnforceFocus>
//         <Fade appear={false} in={bannerOpen}>
//           <Paper
//             role="dialog"
//             aria-modal="false"
//             aria-label="Cookie banner"
//             square
//             variant="outlined"
//             tabIndex={-1}
//             sx={{
//               position: 'fixed',
//               bottom: 0,
//               left: 0,
//               right: 0,
//               m: 0,
//               p: 2,
//               borderWidth: 0,
//               borderTopWidth: 1,
//             }}
//           >
//             <Stack
//               direction={{ xs: 'column', sm: 'row' }}
//               justifyContent="space-between"
//               gap={2}
//             >
//               <Box
//                 sx={{
//                   flexShrink: 1,
//                   alignSelf: { xs: 'flex-start', sm: 'center' },
//                 }}
//               >
//                 <Typography fontWeight="bold">This website uses cookies</Typography>
//                 <Typography variant="body2">
//                   example.com relies on cookies to improve your experience.
//                 </Typography>
//               </Box>
//               <Stack
//                 gap={2}
//                 direction={{
//                   xs: 'row-reverse',
//                   sm: 'row',
//                 }}
//                 sx={{
//                   flexShrink: 0,
//                   alignSelf: { xs: 'flex-end', sm: 'center' },
//                 }}
//               >
//                 <Button size="small" onClick={closeBanner} variant="contained">
//                   Allow all
//                 </Button>
//                 <Button size="small" onClick={closeBanner}>
//                   Reject all
//                 </Button>
//               </Stack>
//             </Stack>
//           </Paper>
//         </Fade>
//       </TrapFocus>
//     </React.Fragment>
//   );
// }
